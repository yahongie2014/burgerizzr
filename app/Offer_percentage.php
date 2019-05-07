<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer_percentage extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offer_percentage';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['offer_id', 'meal_id', 'percentage'];

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
    public function offers()
    {
        return $this->belongsTo(Offer::class, "offer_id");
    }
    public function meals()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }

}
