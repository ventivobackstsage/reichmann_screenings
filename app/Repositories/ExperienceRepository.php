<?php

namespace App\Repositories;

use App\Models\Experience;
use InfyOm\Generator\Common\BaseRepository;

class ExperienceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'candidate_id',
        'Company',
        'Period',
        'Position'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Experience::class;
    }
}
