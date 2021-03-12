<?php

namespace App\Repositories;

use App\Models\TradeHistory;
use App\Repositories\BaseRepository;

/**
 * Class Trade HistoryRepository
 * @package App\Repositories
 * @version December 12, 2020, 7:49 pm UTC
*/

class TradeHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'trade_id',
        'status',
        'username',
        'password',
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
        return TradeHistory::class;
    }
}
