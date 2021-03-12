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
class Quest extends Model
{

    public $table = 'quest';
    



    public $fillable = [
        'username',
        'quest',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'username' => 'string',
        'quest' => 'integer',
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
