<?php
namespace App\Repositories;

use App\Interfaces\RequirementRepositoryInterface;
use App\Models\Requirement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use function Laravel\Prompts\error;

class RequirementRepository implements RequirementRepositoryInterface
{
    public function addRequests($req)
    {   
            // dd($req->all());
        DB::beginTransaction();
        try {
                $fileName = time() . "_" . $req->requested_product_image->getClientOriginalName();
                $newRequirement = new Requirement;
                $newRequirement->customer_name = $req->customer_name;
                $newRequirement->customer_email = $req->customer_email;
                $newRequirement->customer_phone = $req->customer_phone;
                $newRequirement->customer_message = $req->customer_message;
                $newRequirement->requested_product_image = $fileName;
                $newRequirement->page_info = "https://".$req->page_info;
                $newRequirement->timestamps=false;
                $newRequirement->requested_date = now('GMT+5:30');
                $newRequirement->save();

                DB::commit();
                $req->requested_product_image->storeAs("/public/uploads", $fileName); // left you at storage->app/

                $data['code'] = 201;
                $data['error'] = false;
                $data['msg'] = 'Your request has been submitted succesfully. We will contact you shortly.';
                // $data['message'] = error('requested_product_image');
                return $data;
        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            // $data['message'] = error('requested_product_image');
            return $data;
        }

    }
    public function getAllRequests()
    {
        $requirements = Requirement::orderBy('status', 'asc')->orderBy('id', 'desc')->get();
        $data['requirements'] = $requirements;
        return $data;

    }
    public function showRequest($requirement)
    {
        $data['status'] = $requirement->status;
        if ($requirement->status == 0) {
            $update_status = DB::table('requirements')
                ->where('id', $requirement->id)
                ->update(
                    [
                        'status' => 1,
                    ]
                );

            if ($update_status) {
                $data['update_status'] = true;
                $data['requirement'] = $requirement;
            } else {
                $data['update_status'] = false;
            }
        } else {
            $data['requirement'] = $requirement;
        }
        return $data;
    }
    public function addComment($req, $id)
    {

        DB::beginTransaction();
        try {
                $newComment = Requirement::where("id",$id )->first();
                $newComment->timestamps = false;
                $newComment->staff_comment = $req->staff_comment;

                if($newComment->isDirty('staff_comment')){
                    $newComment->save();
                    $data['message'] = 'Comment added successfully.';
                    $data['response'] = 'success';
                }else{
                    $data['message'] = 'This comment is already added.';
                    $data['response'] = 'warning';
                }
                DB::commit();
                $data['code'] = 201;
                $data['error'] = false;
                return $data;
        } catch(\Exception $e) {
            DB::rollBack();
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $e->getMessage();
            $data['message'] = 'Failed to add comment.';
            $data['response'] = 'danger';
            return $data;
        }
        // $currentData = Requirement::find($id)->toArray();
        // $sorted_comment = preg_replace('/\s+/', ' ', $req->staff_comment);
        // if ($sorted_comment != $currentData['staff_comment']) {
        //     $comment = DB::table('requirements')
        //         ->where('id', $id)
        //         ->update(
        //             [
        //                 'staff_comment' => $sorted_comment,
        //             ]
        //         );

        //     if ($comment) {
        //         // Event::dispatch(new SendMail($id));
        //         $data['message'] = 'Comment added successfully.';
        //         $data['response'] = 'success';

        //     } else {
        //         $data['message'] = 'Failed to add comment.';
        //         $data['response'] = 'danger';

        //     }

        // } else {
        //     $data['message'] = 'This comment is already added.';
        //     $data['response'] = 'warning';
        // }
        // return $data;

    }
}