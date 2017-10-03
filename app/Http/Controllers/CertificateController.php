<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Repositories\CertificateRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Certificate;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CertificateController extends InfyOmBaseController
{
    /** @var  CertificateRepository */
    private $certificateRepository;

    public function __construct(CertificateRepository $certificateRepo)
    {
        $this->certificateRepository = $certificateRepo;
    }

    /**
     * Display a listing of the Certificate.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->certificateRepository->pushCriteria(new RequestCriteria($request));
        $certificates = $this->certificateRepository->all();
        return view('admin.certificates.index')
            ->with('certificates', $certificates);
    }

    /**
     * Show the form for creating a new Certificate.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.certificates.create');
    }

    /**
     * Store a newly created Certificate in storage.
     *
     * @param CreateCertificateRequest $request
     *
     * @return Response
     */
    public function store(CreateCertificateRequest $request)
    {
        $input = $request->all();

        $certificate = $this->certificateRepository->create($input);

        Flash::success('Certificate saved successfully.');

        return redirect(route('admin.certificates.index'));
    }

    /**
     * Display the specified Certificate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $certificate = $this->certificateRepository->findWithoutFail($id);

        if (empty($certificate)) {
            Flash::error('Certificate not found');

            return redirect(route('certificates.index'));
        }

        return view('admin.certificates.show')->with('certificate', $certificate);
    }

    /**
     * Show the form for editing the specified Certificate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $certificate = $this->certificateRepository->findWithoutFail($id);

        if (empty($certificate)) {
            Flash::error('Certificate not found');

            return redirect(route('certificates.index'));
        }

        return view('admin.certificates.edit')->with('certificate', $certificate);
    }

    /**
     * Update the specified Certificate in storage.
     *
     * @param  int              $id
     * @param UpdateCertificateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCertificateRequest $request)
    {
        $certificate = $this->certificateRepository->findWithoutFail($id);

        

        if (empty($certificate)) {
            Flash::error('Certificate not found');

            return redirect(route('certificates.index'));
        }

        $certificate = $this->certificateRepository->update($request->all(), $id);

        Flash::success('Certificate updated successfully.');

        return redirect(route('admin.certificates.index'));
    }

    /**
     * Remove the specified Certificate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.certificates.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Certificate::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.certificates.index'))->with('success', Lang::get('message.success.delete'));

       }

}
