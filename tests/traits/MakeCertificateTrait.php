<?php

use Faker\Factory as Faker;
use App\Models\Certificate;
use App\Repositories\CertificateRepository;

trait MakeCertificateTrait
{
    /**
     * Create fake instance of Certificate and save it in database
     *
     * @param array $certificateFields
     * @return Certificate
     */
    public function makeCertificate($certificateFields = [])
    {
        /** @var CertificateRepository $certificateRepo */
        $certificateRepo = App::make(CertificateRepository::class);
        $theme = $this->fakeCertificateData($certificateFields);
        return $certificateRepo->create($theme);
    }

    /**
     * Get fake instance of Certificate
     *
     * @param array $certificateFields
     * @return Certificate
     */
    public function fakeCertificate($certificateFields = [])
    {
        return new Certificate($this->fakeCertificateData($certificateFields));
    }

    /**
     * Get fake data of Certificate
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCertificateData($certificateFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'path' => $fake->word
        ], $certificateFields);
    }
}
