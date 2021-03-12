<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Transaction
 * @package App\Models
 * @version August 19, 2020, 4:02 am UTC
 *
 * @property string $username
 * @property integer $amount
 * @property string $comment
 * @property string $realm
 */
class Transaction extends Model
{

    public $table = 'pvpgn_transaction';
    



    public $fillable = [
        'username',
        'amount',
        'comment',
        'realm'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'username' => 'string',
        'amount' => 'integer',
        'realm' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'username' => 'required'
    ];

    
}
