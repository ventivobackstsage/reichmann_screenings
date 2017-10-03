<?php

namespace App\Repositories;

use App\Models\Education;
use InfyOm\Generator\Common\BaseRepository;

class EducationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'candidate_id',
        'institution',
        'city',
        'Period',
        'Level',
        'certificate_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Education::class;
    }
}
