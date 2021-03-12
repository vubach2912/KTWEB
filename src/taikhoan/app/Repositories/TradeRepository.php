<?php

namespace App\Repositories;

use App\Models\Trade;
use App\Repositories\BaseRepository;

/**
 * Class TradeRepository
 * @package App\Repositories
 * @version December 11, 2020, 8:29 am UTC
*/

class TradeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Trade::class;
    }
}
