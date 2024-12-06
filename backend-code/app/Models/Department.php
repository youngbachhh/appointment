<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Models\User\Role;

class Department extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'departments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'registration_id',
    ];

    /**
     * Relationships
     */

    /**
     * A department can have many appointments.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * A department can have many doctors (users with a specific role).
     */
    public function doctors()
    {
        return $this->hasMany(User::class, 'department_id')
                    ->where('role', '=', Role::DOCTOR->value);
    }

    /**
     * A department belongs to a registration.
     */
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function scopeByName($query, $name)
    {
        return $query->where('name', 'like', "%$name%");
    }

    public function scopeByRegistration($query, $registrationId)
    {
        return $query->where('registration_id', $registrationId);
    }
}
