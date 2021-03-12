<?php

namespace App\Repositories;

use App\Models\BNET;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BNETRepository
 * @package App\Repositories
 * @version August 19, 2020, 6:04 am UTC
*/

class BNETRepository extends BaseRepository
{
    protected $primaryKey = 'uid';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'uid',
        'acct_username',
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
        return BNET::class;
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id, $columns = ['*'])
    {
        $query = $this->model->newQuery();
        $model = $query->firstWhere('uid', '=', $id);
        $model->acct_ctime          = date("c", $model->acct_ctime);
        $model->acct_lastlogin_time = date("c", $model->acct_lastlogin_time);
        $model->auth_locktime       = date("c", $model->auth_locktime);
        return $model;
    }
}
