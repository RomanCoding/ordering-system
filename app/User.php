<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'patronymic', 'description', 'email', 'password', 'department_id',
    ];

    protected $with = ['department'];

    protected $appends = ['department'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A worker belongs to department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Check if a user is an administrator.
     *
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    public function getDepartmentAttribute()
    {
        return Department::find($this->department_id)->first();
    }
}
