<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Approval_Steps extends Model
{
    protected $fillable = [
        'request_approval_id',
        'approver_id',
        'status',
    ];
}
