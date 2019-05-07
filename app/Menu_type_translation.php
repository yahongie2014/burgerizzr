<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_type_translation extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_type_translations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'menu_type_id', 'locale'];

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