<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model  {


    public static function findOrCreate($id)
    {
        $obj = static::find($id);
        return $obj ?: new static;
    }
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'points';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'points'];

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
    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }



}
