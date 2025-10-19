<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval_Rules extends Model
{
    protected $fillable = [
        'department_id',
        'min_amount',
        'max_amount',
        'approval_order',
    ];
    
}
