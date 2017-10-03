<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CertificateApiTest extends TestCase
{
    use MakeCertificateTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCertificate()
    {
        $certificate = $this->fakeCertificateData();
        $this->json('POST', '/api/v1/certificates', $certificate);

        $this->assertApiResponse($certificate);
    }

    /**
     * @test
     */
    public function testReadCertificate()
    {
        $certificate = $this->makeCertificate();
        $this->json('GET', '/api/v1/certificates/'.$certificate->id);

        $this->assertApiResponse($certificate->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCertificate()
    {
        $certificate = $this->makeCertificate();
        $editedCertificate = $this->fakeCertificateData();

        $this->json('PUT', '/api/v1/certificates/'.$certificate->id, $editedCertificate);

        $this->assertApiResponse($editedCertificate);
    }

    /**
     * @test
     */
    public function testDeleteCertificate()
    {
        $certificate = $this->makeCertificate();
        $this->json('DELETE', '/api/v1/certificates/'.$certificate->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/certificates/'.$certificate->id);

        $this->assertResponseStatus(404);
    }
}
