<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model  {
    use  Translatable;

    public $translationModel = Ingredients_translation::class;
    public $translatedAttributes = ['name'];
    public $useTranslationFallback = true;

    const CREATED_AT = 'created_at';
    public $timestamps = true;

    protected $with = ['translations'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ingredients';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cover_image', 'calories','meal_id'];

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

    public function ingredients(){
        return $this->belongsTo(Meal::class,'meal_id');
    }

}
