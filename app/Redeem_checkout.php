<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redeem_checkout extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'redeem_checkout';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'redeem_number', 'points', 'meal_name_user', 'order_long', 'order_lat', 'user_id'];

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

    public function names(){
        return $this->hasMany(Redeem_meal_username::class);
    }

    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function branches(){
        return $this->belongsTo(Branch::class,'branch_id');

    }


}
