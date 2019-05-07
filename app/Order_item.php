<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_items';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['qty', 'price', 'item_id', 'order_id'];

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

    public function Orders(){
        return $this->belongsTo(Order::class,"order_id");
    }
    public function items(){
        return $this->belongsTo(Meal::class,"item_id");
    }
}
