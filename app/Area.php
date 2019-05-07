<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Inani\LaravelNovaConfiguration\Helpers\Configuration;

class Area extends Model  {

    use SoftDeletes, Translatable;

    public $translationModel = Area_translation::class;
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
    protected $table = 'area';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['longitude', 'latitudes', 'status', 'city_id', 'deleted_at'];

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
    protected $dates = ['deleted_at', 'deleted_at'];

    public function cities(){
        return $this->belongsTo(City::class,"city_id");
    }

    public function branches(){
        return $this->hasMany(Branch::class,"area_id");
    }
    public function translatable(){
        return $this->hasMany(Area_translation::class);
    }


    public static function getByNearestLocation($latitude, $longitude)
    {
        $KM = Configuration::get('KM_SEARCH');
        $DISTANCE = Configuration::get('DISTANCE');

        $query ="SELECT area.*, ROUND(" . $KM . " * 3956 * acos( cos( radians('$latitude') ) * cos( radians(latitudes) ) * cos( radians(longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitudes) ) ) ,8) as distance from area where status = 1  and ROUND((" . $KM . " * 3956 * acos( cos( radians('$latitude') ) * cos( radians(latitudes) ) * cos( radians(longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitudes) ) ) ) ,8) <= ".$DISTANCE." order by distance";
        $find = DB::select(DB::raw($query));

        return $find;
    }


    public function getEstimate($user_lat,$user_long,$d_lat,$d_long){
        //Estimate Time To location
        $json_resp = file_get_contents('http://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $user_lat . ',' . $user_long . '&destinations=' . $d_lat . ',' . $d_long);
        $data = json_decode($json_resp);

        return $data;

    }


}
