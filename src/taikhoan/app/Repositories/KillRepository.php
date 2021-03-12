<?php

namespace App\Repositories;

use App\Models\Kill;
use App\Repositories\BaseRepository;

/**
 * Class TransactionRepository
 * @package App\Repositories
 * @version August 19, 2020, 4:02 am UTC
*/

class KillRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'username',
        'charname',
        'amount',
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
        return Kill::class;
    }
    public function getAllFindName($name) {
        $data = Kill::where('username',$name)->get()->sortBy('created_at');
        return $data;
    }
    public function deleteMonster($id){
        return Kill::delete($id);
    }
}
