<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal_price extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meal_price';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['size', 'image', 'meal_id', 'price'];

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

    public function meals(){
        return $this->belongsTo(Meal::class,"meal_id");
    }
    public function meal(){
        return $this->hasMany(PotatoesMeal::class);
    }

}
