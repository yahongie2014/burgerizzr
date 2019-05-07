<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redeem_meal_username extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'redeem_meal_username';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['buyer_name', 'meal_name', 'redeem_id'];

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
        return $this->belongsTo(Redeem_checkout::class,'redeem_id');
    }


}
