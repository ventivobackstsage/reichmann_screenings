<?php

namespace App\Repositories;

use App\Models\Update;
use InfyOm\Generator\Common\BaseRepository;

class UpdateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'status',
        'Description',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Update::class;
    }
}
