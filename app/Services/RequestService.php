<?php

namespace App\Services;
use App\Models\Departments;
use App\Models\RequestApproval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class RequestService
{
    /**
     * Return all departments ordered by name.
     *
     * @return Collection
     */
    public function getDepartments(): Collection
    {
        return Departments::orderBy('name')->get();
    }

    /**
     * Store a new request approval using database transaction
     *
     * @param array $data
     * @return Request_Approvals
     * @throws \Throwable
     */
    public function store(array $data)
    {
        return RequestApproval::create($data); 
    }

    public function findRequestById($id)
    {
        return RequestApproval::findOrFail($id);
    }

    public function getHrManagerRequestApprovals()
    {
        return RequestApproval::query()->with("currentApprover")->where('status', 'pending')->paginate();
    }

    public function getDirectorRequestApprovals()
    {
        return RequestApproval::query()->with("currentApprover")
        ->whereHas("currentApprover", function ($query) {
            $query->where('role', 'hrmanager');
        })
        ->where("amount", ">", 10000)
        ->paginate();
    }


    public function getCfoRequestApprovals()
    {
        return RequestApproval::query()->with("currentApprover")
        ->whereHas("currentApprover", function ($query) {
            $query->where('role', 'director');
        })
        ->paginate();
    }

    public function getCeoRequestApprovals()
    {
        return RequestApproval::query()->with("currentApprover")
        ->whereHas("currentApprover", function ($query) {
            $query->where('role', 'cfo');
        })
        ->paginate();
    }
}