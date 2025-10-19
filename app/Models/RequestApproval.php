<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestApproval extends Model
{

    protected $table = 'request_approvals';

    protected $fillable = [
        'user_id',
        'amount',
        'department_id',
        'status',
        'current_approver_id',
    ];

    public function currentApprover()
    {
        return $this->belongsTo(User::class, 'current_approver_id');
    }
}
