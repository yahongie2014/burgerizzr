<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mealspecs_relation extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mealspecs_relation';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['meal_id', 'specs_id'];

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

    public function related(){
        return $this->belongsToMany(Meal::class,Meals_spec::class);
    }
    public function meals(){
        return $this->belongsTo(Meal::class,"meal_id");
    }
    public function specs(){
        return $this->belongsTo(Meals_spec::class,'specs_id');
    }

}
