<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offers_product extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers_products';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['offers_id', 'meal_id','gift_id'];

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
    public function gifts()
    {
        return $this->belongsTo(Meal::class, 'gift_id');
    }


}
