<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PotatoesMeal extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'PotatoesMeal';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['potatoes_id', 'meal_id'];

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

    public function related(){
        return $this->belongsToMany(Potato::class,Meal_price::class);
    }
    public function potato(){
        return $this->belongsTo(Potato::class,"potatoes_id");
    }
    public function mealprice(){
        return $this->belongsTo(Meal_price::class,'meal_type');
    }

}
