<?php

namespace App;

use App\Nova\Branches;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model  {

    use Translatable;

    public $translationModel = Meals_translation::class;
    public $translatedAttributes = ['name', 'description'];
    public $useTranslationFallback = true;

    const CREATED_AT = 'created_at';
    public $timestamps = true;

    protected $with = ['translations'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meals';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'size','type','menu_type_id', 'branch_id', 'price'];

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
        Mealspecs_relation::class => 'array'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    public function users(){
        return $this->belongsToMany(User::class,Branches::class,"user_id");
    }
    public function images(){
        return $this->hasMany(MealImg::class);
    }
    public function items(){
        return $this->hasMany(Mealspecs_relation::class);
    }
    public function menu(){
        return $this->belongsTo(MenuType::class,"menu_type_id");
    }
    public function drinks(){
        return $this->hasMany(Meals_drink_relation::class);
    }
    public function prices(){
        return $this->hasMany(Meal_price::class);
    }
    public function meals(){
        return $this->belongsTo(Offers_product::class,'meal_id');
    }
    public function offers(){
        return $this->hasMany(Offers_product::class);
    }

    public function ingredients(){
        return $this->hasMany(Ingredient::class);
    }
    public function translatable(){
        return $this->hasMany(Meals_translation::class);
    }




}
