<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'designation',
        'mobile_number',
        'email',
        'password',
        'gender',
        'date_of_birth',
        'status',
        'region_id',
        'branch_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function fullName(): Attribute 
    {
        return Attribute::make(
            get: fn ($value) => $this->first_name . ' ' . $this->last_name,
        );
    }

    public function getLastInsertedPrimaryKey()
    {
        $id = $this->newQuery()->select('id')->orderBy('id','desc')->first();
        $empId = 0;
        if(!empty($id) && !empty($id->id)){
            $empId = $id->id;
        }

        return 'EMP' . (++$empId);
    }

    protected function empId(): Attribute 
    {
        return Attribute::make(
            get: fn ($value) => 'EMP'.$this->id
        );
    }

    public function changePassword($newPassword)
    {
        return true;
    }
}
