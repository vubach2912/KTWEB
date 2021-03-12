<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CheckoutTransaction
 * @package App\Models
 * @version December 19, 2020, 10:04 am UTC
 *
 * @property integer $status
 * @property string $username
 * @property number $amount
 * @property string $checkout_type
 */
class CheckoutTransaction extends Model
{
    use SoftDeletes;

    public $table = 'checkout_transaction';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'status',
        'username',
        'amount',
        'checkout_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'integer',
        'username' => 'string',
        'amount' => 'decimal:2',
        'checkout_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
