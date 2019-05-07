<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'address';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['address', 'notes', 'user_id', 'deleted_at'];

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
    protected $dates = ['deleted_at'];

    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }

}
