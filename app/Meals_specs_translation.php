<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meals_specs_translation extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meals_specs_translation';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'extra_info', 'locale', 'meals_spec_id'];

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
    protected $dates = ['deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at'];

}
