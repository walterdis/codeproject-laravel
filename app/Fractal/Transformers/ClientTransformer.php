<?php
/**
 * Created by PhpStorm.
 * User: Walter
 * Date: 08/08/2015
 * Time: 14:39
 */

namespace CodeProject\Fractal\Transformers;

use CodeProject\Entities\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['projects'];

    /**
     * @param Client $client
     * @return array
     */
    public function transform(Client $client)
    {
        return array(
            'client_id' => $client->id,
            'name' => $client->name,
            'responsible' => $client->responsible,
            'email' => $client->email,
            'phone' => $client->phone,
            'address' => $client->address,
            'obs' => $client->obs
        );

    }

    /**
     * @param Client $client
     * @return mixed
     */
    public function includeProjects(Client $client)
    {
        return $this->collection($client->projects, new ProjectTransformer());
    }

} 