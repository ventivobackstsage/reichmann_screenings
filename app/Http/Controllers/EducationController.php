<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Repositories\EducationRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Education;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class EducationController extends InfyOmBaseController
{
    /** @var  EducationRepository */
    private $educationRepository;

    public function __construct(EducationRepository $educationRepo)
    {
        $this->educationRepository = $educationRepo;
    }

    /**
     * Display a listing of the Education.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->educationRepository->pushCriteria(new RequestCriteria($request));

        if(Sentinel::inRole('admin'))
            $education = $this->educationRepository->all();
        elseif (Sentinel::inRole('candidate')){
            $education = Sentinel::getUser()->candidate->education;
        }


        return view('admin.education.index')
            ->with('education', $education);
    }

    /**
     * Show the form for creating a new Education.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.education.create');
    }

    /**
     * Store a newly created Education in storage.
     *
     * @param CreateEducationRequest $request
     *
     * @return Response
     */
    public function store(CreateEducationRequest $request)
    {
        $input = $request->all();

        $input['candidate_id'] = Sentinel::getUser()->candidate->id;

        $education = $this->educationRepository->create($input);

        Flash::success('Education saved successfully.');

        return redirect(route('admin.education.index'));
    }

    /**
     * Display the specified Education.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $education = $this->educationRepository->findWithoutFail($id);

        if (empty($education)) {
            Flash::error('Education not found');

            return redirect(route('education.index'));
        }

        return view('admin.education.show')->with('education', $education);
    }

    /**
     * Show the form for editing the specified Education.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $education = $this->educationRepository->findWithoutFail($id);

        if (empty($education)) {
            Flash::error('Education not found');

            return redirect(route('education.index'));
        }

        return view('admin.education.edit')->with('education', $education);
    }

    /**
     * Update the specified Education in storage.
     *
     * @param  int              $id
     * @param UpdateEducationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEducationRequest $request)
    {
        $education = $this->educationRepository->findWithoutFail($id);

        

        if (empty($education)) {
            Flash::error('Education not found');

            return redirect(route('education.index'));
        }

        $education = $this->educationRepository->update($request->all(), $id);

        Flash::success('Education updated successfully.');

        return redirect(route('admin.education.index'));
    }

    /**
     * Remove the specified Education from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.education.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Education::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.education.index'))->with('success', Lang::get('message.success.delete'));

       }

}
