<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Un_register_user extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'un_register_user';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['device_id', 'blocked', 'device_type', 'device_token', 'longitude', 'latitudes'];

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

}