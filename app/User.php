<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
class User extends Authenticatable  {
    use HasApiTokens, Notifiable;

    public static function findOrCreate($id)
    {
        $obj = static::find($id);
        return $obj ?: new static;
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'avatar', 'email', 'phone', 'verified', 'v_code', 'blocked', 'email_verified_at', 'password','is_delivery','branch_id','is_admin', 'city_id', 'address_id', 'longitude', 'latitudes', 'remember_token'];

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
    protected $spatialFields = [
        'geo_point',
        'geo_linestring',
        ];
    public function address(){
        return $this->hasMany(Address::class);
    }
    public function cities(){
        return $this->belongsTo(City::class,"city_id");
    }
    public function branch(){
        return $this->belongsTo(Branch::class,"branch_id");
    }

}
