<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\RequestService;
use App\Http\Requests\RequestApproval\RequestApprovalRequest;

class RequestController extends Controller
{
    protected $requestService;

    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }

    public function create()
    {
        $departments = $this->requestService->getDepartments();
        return view('requests.create', compact('departments'));
    }

    public function store(RequestApprovalRequest $request)
    {
        $this->requestService->store($request->validated());

        return redirect()->route('requests.create')->with('success', 'Request approval created successfully.');
    }
}
