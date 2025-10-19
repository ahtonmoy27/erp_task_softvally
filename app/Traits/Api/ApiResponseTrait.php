<?php
namespace App\Traits\Api;

trait ApiResponseTrait
{
    public function sendResponse($code = 200, $message = 'Success', $data = [], $errors = [], $additional = [])
    {
        return response()->json([
            'status'  => $this->getStatusByCode($code),
            "code" => $code,
            'message' => $message,
            'data'    => $data,
            'errors'  => $errors,
            'additional' => $additional
        ], $code);
    }


    public function getStatusByCode($code)
    {
        
        return in_array($code, [200, 201, 202]);
    }

}
