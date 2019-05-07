<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_fee extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'delivery_fees';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fixed_price', 'offer_price', 'type', 'start_in', 'end_in'];

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
    protected $dates = ['start_in', 'end_in'];

}