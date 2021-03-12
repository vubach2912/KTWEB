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
class PVPGNGiftcheck extends Model
{

    public $table = 'pvpgn_giftcheck';
    public $timestamps = false;

    public $fillable = [
        'gift_code',
        'used',
        'username'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'gift_code' => 'string',
        'username' => 'string',
        'used' => 'integer',
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
