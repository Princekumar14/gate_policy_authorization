<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequirementRequest;
use App\Interfaces\RequirementRepositoryInterface;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Event;
use App\Events\SendMail;
class RequirementController extends Controller
{
    protected $requiremetRepository;

    public function __construct(RequirementRepositoryInterface $requiremetRepository)
    {
        $this->requiremetRepository = $requiremetRepository;

    }
    public function addRequirement(RequirementRequest $req)
    {
        $data = $this->requiremetRepository->addRequests($req);
        return $data;

    }

    public function allrequests()
    {
        $data = $this->requiremetRepository->getAllRequests();
        return view('customer_requirements', $data);
    }

    public function showRequest(Requirement $requirement)
    {
        $data = $this->requiremetRepository->showRequest($requirement);
        if ($data['status'] == 0) {
            if ($data['update_status']) {
                return view('show_customer_requirement', $data);
            } else {
                echo "<h1>Something went wrong plz try again.</h1>";
            }
        } else {
            return view('show_customer_requirement', $data);
        }
    }

    public function addComment(Request $req, $id)
    {
        $data = $this->requiremetRepository->addComment($req, $id);
        if ($data['response'] == 'success') {
            return Redirect::route('customer.requirements')->with($data);

        } else {
            return Redirect::back()->with($data);
        }
    }

    public function takecsrf(Request $req)
    {
        $data['csrf_token'] = $req->session()->token();

        return json_encode($data);
    }

}