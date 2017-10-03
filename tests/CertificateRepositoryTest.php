<?php

use App\Models\Certificate;
use App\Repositories\CertificateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CertificateRepositoryTest extends TestCase
{
    use MakeCertificateTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CertificateRepository
     */
    protected $certificateRepo;

    public function setUp()
    {
        parent::setUp();
        $this->certificateRepo = App::make(CertificateRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCertificate()
    {
        $certificate = $this->fakeCertificateData();
        $createdCertificate = $this->certificateRepo->create($certificate);
        $createdCertificate = $createdCertificate->toArray();
        $this->assertArrayHasKey('id', $createdCertificate);
        $this->assertNotNull($createdCertificate['id'], 'Created Certificate must have id specified');
        $this->assertNotNull(Certificate::find($createdCertificate['id']), 'Certificate with given id must be in DB');
        $this->assertModelData($certificate, $createdCertificate);
    }

    /**
     * @test read
     */
    public function testReadCertificate()
    {
        $certificate = $this->makeCertificate();
        $dbCertificate = $this->certificateRepo->find($certificate->id);
        $dbCertificate = $dbCertificate->toArray();
        $this->assertModelData($certificate->toArray(), $dbCertificate);
    }

    /**
     * @test update
     */
    public function testUpdateCertificate()
    {
        $certificate = $this->makeCertificate();
        $fakeCertificate = $this->fakeCertificateData();
        $updatedCertificate = $this->certificateRepo->update($fakeCertificate, $certificate->id);
        $this->assertModelData($fakeCertificate, $updatedCertificate->toArray());
        $dbCertificate = $this->certificateRepo->find($certificate->id);
        $this->assertModelData($fakeCertificate, $dbCertificate->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCertificate()
    {
        $certificate = $this->makeCertificate();
        $resp = $this->certificateRepo->delete($certificate->id);
        $this->assertTrue($resp);
        $this->assertNull(Certificate::find($certificate->id), 'Certificate should not exist in DB');
    }
}
