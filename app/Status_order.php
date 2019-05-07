<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_order extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'status_order';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'status_code', 'order_id'];

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

    public function orders(){
        return $this->belongsTo(Order::class,"order_id");
    }


}
