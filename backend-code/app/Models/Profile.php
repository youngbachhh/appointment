<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Models\Profile\InsuranceType;
use App\Enums\Models\Profile\Gender;
use App\Enums\Models\Profile\Priority;
use App\Enums\Models\Profile\Age;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'birthdate',
        'gender',
        'province_id',
        'ethnicity',
        'phone',
        'address',
        'insurance_type',
        'insurance_number',
        'insurance_expiration',
        'priority',
        'status',
        'job',
    ];

    // protected $casts = [
    //     'insurance_type' => InsuranceType::class
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function getInsuranceTypeAttribute($value)
    {
        return match($value) {
            InsuranceType::HEALTH->value => 'Bảo hiểm y tế',
            InsuranceType::PRIVATE->value => 'Bảo hiểm tư nhân',
            InsuranceType::NONE->value => 'Không có bảo hiểm',
            default => 'Không xác định',
        };
    }

    public function getGenderAttribute($value)
    {
        $genders = [
            Gender::MALE->value => 'Nam',
            Gender::FEMALE->value => 'Nữ',
            Gender::OTHER->value => 'Khác',
        ];
        return $genders[$value] ?? 'Khác';
    }

    public function setPriorityAttribute()
    {
        $age = now()->diffInYears($this->attributes['birthdate']);
        
        if ($age >= Age::ELDERLY->value) {
            $this->attributes['priority'] = Priority::ELDERLY->value;
        } elseif ($age <= Age::CHILDREN->value) {
            $this->attributes['priority'] = Priority::CHILDREN->value;
        }

        $this->attributes['priority'] = Priority::OTHER->value;
    }
}
