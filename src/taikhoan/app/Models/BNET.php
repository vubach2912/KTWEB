<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class BNET
 * @package App\Models
 * @version August 19, 2020, 6:04 am UTC
 *
 * @property integer $username
 * @property string $acct_passhash1
 * @property string $acct_email
 * @property integer $auth_lock
 * @property string $auth_locktime
 * @property string $auth_lockreason
 * @property integer $auth_command_groups
 * @property string $acct_lastlogin_time
 * @property string $acct_lastlogin_ip
 * @property string $acct_ctime
 * @property string $auth_lockby
 */
class BNET extends Model
{

    public $table = 'pvpgn_bnet';

    protected $primaryKey = 'uid';



    public $fillable = [
        'username',
        'acct_passhash1',
        'acct_email',
        'auth_lock',
        'auth_locktime',
        'auth_lockreason',
        'auth_command_groups',
        'acct_lastlogin_time',
        'acct_lastlogin_ip',
        'acct_ctime',
        'auth_lockby'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'username' => 'integer',
        'acct_passhash1' => 'string',
        'acct_email' => 'string',
        'auth_lock' => 'integer',
        'auth_lockreason' => 'string',
        'auth_command_groups' => 'integer',
        'acct_lastlogin_ip' => 'string',
        'auth_lockby' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'username' => 'required'
    ];
//
//    public function changePassword($password){
//        $this->acct_passhash1 =
//    }


}
