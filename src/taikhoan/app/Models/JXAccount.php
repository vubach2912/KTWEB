<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class BNET
 * @package App\Models
 * @version August 19, 2020, 6:04 am UTC
 *
 * @property string $loginName
 * @property string $password_hash
 * @property string $email
 * @property integer $coin
 */
class JXAccount extends Model
{

    public $table = 'account';
    public $timestamps = false;

    protected $primaryKey = 'Id';

    public $fillable = [
        'loginName',
        'password_hash',
        'email',
        'coin'
    ];

    /**
     * The attributes that should be casted to native types.
     *x
     * @var array
     */
    protected $casts = [
        'loginName' => 'string',
        'password_hash' => 'string',
        'email' => 'string',
        'coin' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'loginName' => 'required'
    ];

}
