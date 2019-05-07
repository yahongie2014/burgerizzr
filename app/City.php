<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model  {
    use SoftDeletes, Translatable;

    public $translationModel = Cities_translation::class;
    public $translatedAttributes = ['name','cities_id'];
    public $useTranslationFallback = true;

    const CREATED_AT = 'created_at';
    public $timestamps = true;

    protected $with = ['translations'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['longitude', 'latitudes', 'status', 'country_id', 'deleted_at'];

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
    protected $dates = ['deleted_at', 'deleted_at', 'deleted_at', 'deleted_at'];

    public function country(){

        return $this->belongsTo(Country::class,"country_id");
    }
    public function user(){
        return $this->hasMany(User::class);
    }
    public function areas(){
        return $this->hasMany(Area::class);

    }
    public function translatable(){
        return $this->hasMany(Cities_translation::class);
    }


}
