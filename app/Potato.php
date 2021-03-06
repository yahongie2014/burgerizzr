<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potato extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'potatoes';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','size', 'type', 'calories', 'price'];

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

    public function meal(){
        return $this->belongsTo(PotatoesMeal::class);
    }

}
