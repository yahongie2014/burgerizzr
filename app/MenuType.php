<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class MenuType extends Model  {

    use Translatable;

    public $translationModel = Menu_type_translation::class;
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
    protected $table = 'menu_type';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['status'];

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
        return $this->hasMany(Meal::class);
    }
    public function translatable(){
        return $this->hasMany(Menu_type_translation::class);
    }

}
