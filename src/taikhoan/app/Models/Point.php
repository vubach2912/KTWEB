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
class Point extends Model
{

    public $table = 'd2vn_clan_member';
    



    public $fillable = [
        'acs_name',
        'clan_name',
        'realm'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'acs_name' => 'string',
        'clan_name'=>'string',
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
