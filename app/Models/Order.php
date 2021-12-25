<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'patient_first_name',
        'patient_last_name',
        'patient_date_of_birth',
        'patient_phone',
        'patient_email',
        'reason_of_test',
        'covid_test_type',
        'date_of_test',
    ];
    
    public function getPatientNameAttribute()
    {
        return "{$this->patient_first_name} {$this->patient_last_name}";
    }

    public function getFormattedDateOfBirthAttribute()
    {
        return Carbon::parse($this->patient_date_of_birth)->format('m/d/Y');
    }

    public function getFormattedDateOfTestAttribute()
    {
        if ($this->date_of_test) {
            return Carbon::parse($this->date_of_test)->format('m/d/Y');
        }

        return null;
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }
}
