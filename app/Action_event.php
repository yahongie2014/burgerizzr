<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action_event extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'action_events';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['batch_id', 'user_id', 'name', 'actionable_type', 'actionable_id', 'target_type', 'target_id', 'model_type', 'model_id', 'fields', 'status', 'exception'];

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