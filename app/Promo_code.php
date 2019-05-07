<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo_code extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'promo_codes';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'code'];

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
    protected $casts = [
        'start_in' => 'datetime',
        'end_in' => 'datetime'
    ];
    protected $dates = ['start_in', 'end_in'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

}
