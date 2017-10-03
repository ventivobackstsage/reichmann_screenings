<?php

namespace App\Repositories;

use App\Models\Candidate;
use InfyOm\Generator\Common\BaseRepository;

class CandidateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cnp',
        'address',
        'city',
        'country'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Candidate::class;
    }
}
