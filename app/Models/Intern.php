<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intern extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'field', // New field for specialization
        'join_date',
        'leave_date',
    ];

    // You can add any additional methods or relationships here if needed
}
