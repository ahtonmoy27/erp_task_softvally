<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Api\ApiResponseTrait;
use App\Http\Requests\ApprovalRequestStoreRequest;

use App\Models\RequestApproval;
use App\Services\RequestService;
use PhpParser\Node\Stmt\TryCatch;

class ApprovalRequestController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request, RequestService $requestService)
    {
        try {
            // Get approval requests for the hr
            $approvalRequests = RequestApproval::where('user_id', userId())->paginate();


            if(isHrManager()){
                $approvalRequests = $requestService->getHrManagerRequestApprovals();
            }

            if(isDirector()){
                $approvalRequests = $requestService->getDirectorRequestApprovals();
            }

            if(isCfo()){
                $approvalRequests = $requestService->getCfoRequestApprovals();
            }

             if(isCeo()){
                $approvalRequests = $requestService->getCeoRequestApprovals();
            }


            return $this->sendResponse(200, 'Approval requests retrieved successfully', $approvalRequests);
        } catch (\Exception $e) {

            return $this->sendResponse(500, 'Internal Server Error', null, [$e->getMessage()]);
        }
    }

 

    // Create new approval request
    public function store(ApprovalRequestStoreRequest $request)
    {
        try {

            $data = $request->validated();
            $data["user_id"] = auth()->id();
            $approvalRequest = RequestApproval::create($data);

            return $this->sendResponse(201, 'Approval request created successfully', $approvalRequest);
        } catch (\Exception $e) {
            return $this->sendResponse(500, 'Internal Server Error', null, [$e->getMessage()]);
        }
    }

    public function approve(Request $request, $id, RequestService $requestService)
    {
        try {

            $requestApproval = $requestService->findRequestById($id);

            // Logic to approve the request
            $requestApproval->status = $request->status;
            $requestApproval->current_approver_id = userId();
            $requestApproval->save();

            // load relationships
            $requestApproval->load("currentApprover");

            
            return $this->sendResponse(200, 'Request approved successfully', $requestApproval);

        } catch (\Exception $e) {
            return $this->sendResponse(500, 'Internal Server Error', null, [$e->getMessage()]);
        }
    }
}
