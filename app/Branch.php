<?php

namespace App;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Inani\LaravelNovaConfiguration\Helpers\Configuration;

class Branch extends Model  {
    use SpatialTrait;
    protected $spatialFields = [
        'geo_point',
        'geo_linestring'
        ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branches';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'area_id', 'status','is_delivery_status','latitudes','longitude'];

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
    protected $dates = ['deleted_at', 'deleted_at', 'deleted_at'];


    public function areas(){
        return $this->belongsTo(Area::class,"area_id");
    }
    public function delivery(){
        return $this->hasMany(Branches_delivery::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
    public static function getByNearestLocation($latitude, $longitude)
    {
        $KM = Configuration::get('KM_SEARCH');
        $DISTANCE = Configuration::get('DISTANCE');

        $query ="SELECT branches.*, ROUND(" . $KM . " * 3956 * acos( cos( radians('$latitude') ) * cos( radians(latitudes) ) * cos( radians(longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitudes) ) ) ,8) as distance from branches where status = 1  and ROUND((" . $KM . " * 3956 * acos( cos( radians('$latitude') ) * cos( radians(latitudes) ) * cos( radians(longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitudes) ) ) ) ,8) >= ".$DISTANCE." order by distance";
        $find = DB::select(DB::raw($query));

        return $find;
    }

}
