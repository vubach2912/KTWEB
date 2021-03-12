<?php

namespace App\Repositories;

use App\Models\TradeAccount;
use App\Repositories\BaseRepository;

/**
 * Class TradeAccountRepository
 * @package App\Repositories
 * @version December 13, 2020, 3:20 pm UTC
*/

class TradeAccountRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'username',
        'password',
        'status'
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
        return TradeAccount::class;
    }
}
