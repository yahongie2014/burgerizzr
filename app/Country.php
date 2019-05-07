<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;


class Country extends Model  {

    use Translatable;

    public $translationModel = Countries_translation::class;
    public $translatedAttributes = ['name'];
    public $useTranslationFallback = true;
    public $translatable = ['name'];
    const CREATED_AT = 'created_at';
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['flag', 'status', 'code'];

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

    public function cities(){
        return $this->hasMany(City::class);
    }
    public function translatable(){
        return $this->hasMany(Countries_translation::class);
    }


}
