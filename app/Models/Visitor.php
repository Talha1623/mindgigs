<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    
    protected $fillable = [
        'name',
        'contact',
        'email',
        'source',
        'purpose',
        'person_to_meet',
        'added_by', // NEW: who added this
    ];

   // In Visitor.php model
public function addedBy()
{
    return $this->belongsTo(User::class, 'added_by');
}


}
