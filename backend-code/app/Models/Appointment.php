<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appointments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'doctor_id',
        'service_id',
        'profile_id',
        'date',
        'time_start',
        'time_end',
        'status',
        'notes',
        'reminder_sent',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
        'time_start' => 'datetime:H:i:s',
        'time_end' => 'datetime:H:i:s',
        'status' => 'integer',
    ];

    /**
     * Relationships
     */

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function service()
    {
        return $this->hasOne(Service::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * Query Scopes
     */

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', now()->format('Y-m-d'))
                     ->where('time_start', '>=', now()->format('H:i:s'));
    }

    public function scopeByDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    public function scopeByDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function scopeByTimeRange($query, $timeStart, $timeEnd)
    {
        return $query->whereBetween('time_start', [$timeStart, $timeEnd])
                     ->orWhereBetween('time_end', [$timeStart, $timeEnd]);
    }
}
