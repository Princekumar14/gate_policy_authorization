<?php
namespace App\Interfaces;

interface RequirementRepositoryInterface{
    public function addRequests($req);

    public function getAllRequests();

    public function showRequest($requirement);

    public function addComment($req, $id);
} 