<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'path', 'status', 'percentage', 'start_in', 'end_in'];

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
    protected $casts = [
        'start_in' => 'datetime',
        'end_in' => 'datetime'

    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_in', 'end_in'];

    public function meals(){
        return $this->hasMany(Offers_product::class);
    }
    public function meals_percentage(){
        return $this->hasMany(Offer_percentage::class);
    }
    public function gifts(){
        return $this->hasMany(Offers_product::class);
    }
    public function branches(){
        return $this->hasMany(Offer_branch::class);

    }

}
