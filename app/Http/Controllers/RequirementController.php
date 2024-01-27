<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequirementRequest;
use App\Interfaces\RequirementRepositoryInterface;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RequirementController extends Controller
{
    protected $requiremetRepository;

    public function __construct(RequirementRepositoryInterface $requiremetRepository)
    {
        $this->requiremetRepository = $requiremetRepository;

    }
    public function addRequirement(RequirementRequest $req)
    {
        return $this->requiremetRepository->addData($req);
        
    }

    public function takecsrf(Request $req)
    {
        $data['csrf_token'] = $req->session()->token();

        return json_encode($data);
    }

    public function allrequests(Request $req)
    {
        $requirements = Requirement::orderBy('status', 'asc')->orderBy('id', 'desc')->get();
        return view('customer_requirements', compact('requirements'));
    }

    public function showRequest(Requirement $requirement)
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

    public function addComment(Request $req, $id)
    {

        $comment = DB::table('requirements')
            ->where('id', $id)
            ->update(
                [
                    'staff_comment' => preg_replace('/\s+/', ' ', $req->staff_comment),
                ]
            );

        if ($comment) {
            return Redirect::back();
            // echo "<h1>Data Updated Successfully.</h1>";

        } else {
            echo "<h1>Failed to Update Data.</h1>";

        }
        // dd($req);
        // return "hi";
    }
}
