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
        return $this->requiremetRepository->addRequests($req);
        
    }

    public function takecsrf(Request $req)
    {
        $data['csrf_token'] = $req->session()->token();

        return json_encode($data);
    }

    public function allrequests()
    {
        return $this->requiremetRepository->getAllRequests();
    }

    public function showRequest(Requirement $requirement)
    {
        return $this->requiremetRepository->showRequest($requirement);
    }

    public function addComment(Request $req, $id)
    {

        return $this->requiremetRepository->addComment($req, $id);
    }
}
