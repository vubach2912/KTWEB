<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Trade History
 * @package App\Models
 * @version December 12, 2020, 7:49 pm UTC
 *
 * @property integer $trade_id
 * @property integer $status
 * @property string $username
 * @property string $password
 * @property number $amount
 * @property string $amount_type
 */
class TradeHistory extends Model
{
    use SoftDeletes;

    public $table = 'market_trade_history';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'trade_id',
        'status',
        'username',
        'password',
        'amount',
        'amount_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trade_id' => 'integer',
        'status' => 'integer',
        'username' => 'string',
        'password' => 'string',
        'amount' => 'float',
        'amount_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
