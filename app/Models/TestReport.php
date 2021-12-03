<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'first_name',
        'last_name',
        'birthdate'
    ];

    public function getPatientNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
