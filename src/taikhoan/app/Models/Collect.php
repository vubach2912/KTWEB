<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Collect
 * @package App\Models
 * @version December 22, 2020, 8:45 am UTC
 *
 * @property string $realm
 * @property string $charname
 * @property string $username
 * @property string $item
 * @property integer $amount
 * @property string $comment
 * @property string $created_at
 */
class Collect extends Model
{

    public $table = 'pvpgn_collect';

    public $fillable = [
        'realm',
        'charname',
        'username',
        'item',
        'amount',
        'comment',
        'created_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'realm' => 'string',
        'charname' => 'string',
        'username' => 'string',
        'item' => 'string',
        'amount' => 'integer',
        'comment' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
