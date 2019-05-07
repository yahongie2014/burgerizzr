<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password_reset extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'token'];

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

}