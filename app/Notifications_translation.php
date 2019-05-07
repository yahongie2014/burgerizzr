<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications_translation extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notifications_translation';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'message', 'notification_id', 'locale'];

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