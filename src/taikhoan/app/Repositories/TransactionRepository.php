<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\BaseRepository;

/**
 * Class TransactionRepository
 * @package App\Repositories
 * @version August 19, 2020, 4:02 am UTC
*/

class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'username',
        'amount',
        'comment',
        'realm',
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
        return Transaction::class;
    }
    public function getAllFindName($name){
        $data = Transaction::where('username',$name)->get()->sortBy('created_at');
        return $data;
    }
    public function Surplus($name){
        $data = Transaction::where('username',$name)->sum('amount');
        return $data;
    }

    public function getSurplus($name){
        $data = Transaction::where('username',$name)->where('amount','>',0)->sum('amount');
        return $data;
    }

}
