<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class TradeAccount
 * @package App\Models
 * @version December 13, 2020, 3:20 pm UTC
 *
 * @property string $username
 * @property string $password
 * @property integer $status
 */
class TradeAccount extends Model
{

    public $table = 'market_trade_account';
    



    public $fillable = [
        'username',
        'password',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'username' => 'string',
        'password' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
