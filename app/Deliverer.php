<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliverer extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deliverers';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'vehicle_id', 'license_id'];

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

    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }

}
