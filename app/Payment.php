<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'card_number', 'payment_option', 'expiry_date', 'customer_ip', 'status', 'payment_status', 'fort_id', 'signature', 'amount', 'order_number', 'currency', 'authorization_code', 'order_description'];

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
    protected $dates = ['deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'deleted_at', 'expires_at', 'expires_at', 'expires_at'];

    public function users(){
        return $this->belongsTo(User::class,"user_id");
    }

}
