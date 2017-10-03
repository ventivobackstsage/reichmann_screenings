<?php

namespace App\Repositories;

use App\Models\Certificate;
use InfyOm\Generator\Common\BaseRepository;

class CertificateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'path'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Certificate::class;
    }
}
