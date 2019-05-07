<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealImg extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meals_images';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['meal_id', 'path'];

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

    public function meal(){
        return $this->belongsTo(Meal::class,"meal_id");
    }
}
