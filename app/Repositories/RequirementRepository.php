<?php
namespace App\Repositories;

use App\Interfaces\RequirementRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RequirementRepository implements RequirementRepositoryInterface
{
    public function addData($req)
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
}
