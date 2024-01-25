<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequirementRequest;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequirementController extends Controller
{
    public function addRequirement(RequirementRequest $req)
    {
        // $data['message']= "done";
        // $data['_token'] = $req->header('X-CSRF-TOKEN');
    //    return print_r($req->all());
       $fileName = time()."_".$req->requested_product_image->getClientOriginalName();
       $req->requested_product_image->storeAs("/public/uploads", $fileName);  // left you at storage->app/
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

    public function takecsrf(Request $req)
    {
        $data['csrf_token'] = $req->session()->token();

        return json_encode($data);
    }

    public function allrequests(Request $req)
    {
        $requirements = Requirement::get();
        return view('customer_requirements', compact('requirements'));
    }


    public function showRequest(Requirement $requirement)
    {
        if($requirement->status == 0){
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

        }else{
            return view('show_customer_requirement')->with('requirement', $requirement);
        }
    }

    public function addComment(Request $req)
    {
        return "hi";
    }
}
