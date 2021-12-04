<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TestReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'first_name',
        'last_name',
        'birthdate',
        'is_covid_postive'
    ];

    public function setIsCovidPositiveAttribute($value)
    {
        $this->attributes['is_covid_positive'] = $value === 'positive' ? true : false;
    }
    
    public function getPatientNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getCovidResultAttribute()
    {
        return $this->is_covid_positive ? 'Positive' : 'Negative';
    }

    public function getFileUrlAttribute()
    {
        return Storage::url($this->file);
    }

    public function getFormattedDateOfBirthAttribute()
    {
        return Carbon::parse($this->birthdate)->format('m/d/Y');
    }
}
