<?php

namespace App\Repositories;

use App\Models\Attachement;
use InfyOm\Generator\Common\BaseRepository;

class AttachementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Attachement::class;
    }
}
