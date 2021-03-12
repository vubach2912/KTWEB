<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Trade
 * @package App\Models
 * @version December 11, 2020, 8:29 am UTC
 *
 * @property integer $seller_id
 * @property integer $storage_char_id
 * @property string $difficulty
 * @property string $item_type
 * @property string $name
 * @property string $note
 * @property string $quality
 * @property string $image
 * @property integer $amount
 * @property string $amount_type
 */
class Trade extends Model
{
    use SoftDeletes;

    public $table = 'market_trade';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'seller_id',
        'storage_char_id',
        'difficulty',
        'item_type',
        'name',
        'note',
        'quality',
        'image',
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
        'seller_id' => 'integer',
        'storage_char_id' => 'integer',
        'difficulty' => 'string',
        'item_type' => 'string',
        'name' => 'string',
        'note' => 'string',
        'quality' => 'string',
        'image' => 'string',
        'amount' => 'integer',
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
