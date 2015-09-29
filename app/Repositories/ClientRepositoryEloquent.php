<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 23/07/2015
 * Time: 13:54
 */

namespace CodeProject\Repositories;

use CodeProject\Fractal\Presenters\ClientPresenter;
use CodeProject\Repositories\Contracts\ClientRepository;
use CodeProject\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    protected $fieldSearchable = [
        'name', 'email'
    ];

    public function model()
    {
        return Client::class;
    }


    /**
     * @return mixed
     */
    public function presenter()
    {
        return ClientPresenter::class;
    }

    public function boot() {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

} 