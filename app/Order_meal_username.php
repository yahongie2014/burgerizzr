<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_meal_username extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_meal_username';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['buyer_name', 'meal_name', 'order_id'];

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
    protected $dates = [];
    public function order_users(){
        return $this->belongsTo(Order::class,'order_id');
    }

}
