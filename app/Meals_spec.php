<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meals_spec extends Model  {

    use  Translatable;

    public $translationModel = Meals_specs_translation::class;
    public $translatedAttributes = ['name', 'extra_info'];
    public $useTranslationFallback = true;

    const CREATED_AT = 'created_at';
    public $timestamps = true;

    protected $with = ['translations'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meals_specs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['size', 'status', 'price'];

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
        return $this->belongsTo(Mealspecs_relation::class,"specs_id");
    }

}
