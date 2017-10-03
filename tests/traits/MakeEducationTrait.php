<?php

use Faker\Factory as Faker;
use App\Models\Education;
use App\Repositories\EducationRepository;

trait MakeEducationTrait
{
    /**
     * Create fake instance of Education and save it in database
     *
     * @param array $educationFields
     * @return Education
     */
    public function makeEducation($educationFields = [])
    {
        /** @var EducationRepository $educationRepo */
        $educationRepo = App::make(EducationRepository::class);
        $theme = $this->fakeEducationData($educationFields);
        return $educationRepo->create($theme);
    }

    /**
     * Get fake instance of Education
     *
     * @param array $educationFields
     * @return Education
     */
    public function fakeEducation($educationFields = [])
    {
        return new Education($this->fakeEducationData($educationFields));
    }

    /**
     * Get fake data of Education
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEducationData($educationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'candidate_id' => $fake->randomDigitNotNull,
            'institution' => $fake->word,
            'city' => $fake->word,
            'Period' => $fake->word,
            'Level' => $fake->word,
            'certificate_id' => $fake->word
        ], $educationFields);
    }
}
