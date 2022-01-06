<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'patient_id',
        'patient_name',
        'patient_date_of_birth',
        'patient_phone',
        'patient_email',
        'reason_of_test',
        'covid_test_type',
        'date_of_test',
    ];

    public function setPatientDateOfBirthAttribute($value)
    {
        $this->attributes['patient_date_of_birth'] = Carbon::createFromFormat('m/d/Y', $value)->toDateString();
    }

    public function setDateOfTestAttribute($value)
    {
        $this->attributes['date_of_test'] = Carbon::createFromFormat('m/d/Y', $value)->toDateString();
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

    public function getVitalsDocumentUrlAttribute()
    {
        return Storage::url($this->vitals_document);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }

    public function routeNotificationForNexmo($notification)
    {
        return $this->patient_sms_phone_number;
    }

    public function getPatientSmsPhoneNumberAttribute()
    {
        return '1' . preg_replace('/[^0-9]/', '', $this->patient_phone);
    }
}
