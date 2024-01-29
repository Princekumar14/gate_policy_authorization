<?php
namespace App\Repositories;

use App\Interfaces\RequirementRepositoryInterface;
use App\Models\Requirement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RequirementRepository implements RequirementRepositoryInterface
{
    public function addRequests($req)
    {
        $fileName = time() . "_" . $req->requested_product_image->getClientOriginalName();
        $req->requested_product_image->storeAs("/public/uploads", $fileName); // left you at storage->app/
        $requirement = DB::table('requirements')
            ->insert(
                [
                    'customer_name' => $req->customer_name,
                    'customer_email' => $req->customer_email,
                    'customer_phone' => $req->customer_phone,
                    'customer_message' => $req->customer_message,
                    'requested_product_image' => $fileName,
                    'page_info' => $req->page_info,
                    'requested_date' => now('GMT+5:30'),
                ]
            );
        if ($requirement) {
            return true;
            // "Your request has been submitted succesfully. We will contact you shortly.";

        } else {
            return false;
            // "Something went wrong please try again later.";

        }

    }
    public function getAllRequests()
    {
        $requirements = Requirement::orderBy('status', 'asc')->orderBy('id', 'desc')->get();
        return view('customer_requirements', compact('requirements'));
    }
    public function showRequest($requirement)
    {
        if ($requirement->status == 0) {
            $update_status = DB::table('requirements')
                ->where('id', $requirement->id)
                ->update(
                    [
                        'status' => 1,
                    ]
                );
            if ($update_status) {
                return view('show_customer_requirement')->with('requirement', $requirement);

            } else {
                echo "<h1>Something went Wrong.</h1>";

            }

        } else {
            return view('show_customer_requirement')->with('requirement', $requirement);
        }
    }
    public function addComment($req, $id)
    {
        $currentData = Requirement::find($id)->toArray();
        $sorted_comment = preg_replace('/\s+/', ' ', $req->staff_comment);
        if($sorted_comment != $currentData['staff_comment']){
            $comment = DB::table('requirements')
                ->where('id', $id)
                ->update(
                    [
                        'staff_comment' => $sorted_comment,
                    ]
                );
    
            if ($comment) {
                // Event::dispatch(new SendMail($id));
                return Redirect::route('customer.requirements')->with(['message' => 'Comment added successfully.', 'response' => 'success']);
    
            } else {
                return Redirect::back()->with(['message', 'Failed to add comment.', 'response' => 'danger']);
    
            }

        }else{
            return Redirect::back()->with(['message' => 'This comment is already added.', 'response' => 'warning']);
        }

    }
}
