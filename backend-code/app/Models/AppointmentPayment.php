<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentPayment extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appointment_payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appointment_id',
        'amount',
        'payment_method',
        'is_insurance_covered',
        'status',
    ];

    /**
     * Relationships
     */

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /**
     * Accessors & Mutators
     */

    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2) . ' $';
    }

    /**
     * Scopes
     */

    public function scopeByPaymentMethod($query, $method)
    {
        return $query->where('payment_method', $method);
    }

    public function scopeInsuranceCovered($query)
    {
        return $query->where('is_insurance_covered', true);
    }
}
