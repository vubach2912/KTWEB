<?php

namespace App\Repositories;

use App\Models\Collect;
use App\Repositories\BaseRepository;

/**
 * Class CollectRepository
 * @package App\Repositories
 * @version December 22, 2020, 8:45 am UTC
*/

class CollectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'realm',
        'charname',
        'username',
        'item',
        'amount',
        'comment',
        'created_at'
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
        return Collect::class;
    }
}
