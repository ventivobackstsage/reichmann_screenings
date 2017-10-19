<?php

namespace App\Repositories;

use App\Models\Other;
use InfyOm\Generator\Common\BaseRepository;

class OtherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'date',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Other::class;
    }
}
