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
    
    public function outgoingOrders()
    {
        return $this->hasMany(Order::class, 'creator_id')->orderBy('due_date');
    }

    public function incomingOrders()
    {
        return $this->hasMany(Order::class, 'worker_id')->orderBy('due_date');
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
        return Department::findOrFail($this->department_id)->first();
    }

    public function scopeWorkers($query)
    {
        return $query->where('admin', 0);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    
    public function createOrder($order)
    {
        return $this->outgoingOrders()->create([
            'worker_id' => $order['worker_id'],
            'due_date' => $order['due_date'],
            'title' => $order['title'],
            'body' => $order['body'],
            'important' => $order['important']
        ]);
    }
}
