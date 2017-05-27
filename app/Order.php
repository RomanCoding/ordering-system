<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['worker_id', 'body', 'title', 'due_date'];

    protected $with = ['creator', 'worker'];

    protected $appends = ['creator', 'worker'];

    /**
     * A person who created an order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * A person who will do this order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    /**
     * Messages related to an order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getCreatorAttribute()
    {
        return $this->creator();
    }

    public function getWorkerAttribute()
    {
        return $this->worker();
    }
}
