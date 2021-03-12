<?php

namespace App\Repositories;

use App\Models\CheckoutTransaction;
use App\Repositories\BaseRepository;

/**
 * Class CheckoutTransactionRepository
 * @package App\Repositories
 * @version December 19, 2020, 10:04 am UTC
*/

class CheckoutTransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'username',
        'amount',
        'checkout_type'
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
        return CheckoutTransaction::class;
    }
}
