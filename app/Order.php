<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['status','branch_id', 'order_number', 'order_long', 'order_lat', 'user_id', 'promo_id', 'total','data'];

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

    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function order_items(){
        return $this->hasMany(Order_item::class);
    }

    public function order_users(){
        return $this->hasMany(Order_meal_username::class);

    }

    public function promo(){
        return $this->belongsTo(Promo_code::class,"promo_id");
    }

    public function branches(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
}
