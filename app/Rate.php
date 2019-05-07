<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rates';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'stars', 'notes'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'expires_at', 'expires_at', 'expires_at'];

    public function users()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, "branch_id");
    }
    public function orders(){
        return $this->belongsTo(Order::class,"order_id");
    }
}
