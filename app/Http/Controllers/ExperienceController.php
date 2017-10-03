<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Repositories\ExperienceRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Experience;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ExperienceController extends InfyOmBaseController
{
    /** @var  ExperienceRepository */
    private $experienceRepository;

    public function __construct(ExperienceRepository $experienceRepo)
    {
        $this->experienceRepository = $experienceRepo;
    }

    /**
     * Display a listing of the Experience.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->experienceRepository->pushCriteria(new RequestCriteria($request));
        $experiences = $this->experienceRepository->all();
        return view('admin.experiences.index')
            ->with('experiences', $experiences);
    }

    /**
     * Show the form for creating a new Experience.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.experiences.create');
    }

    /**
     * Store a newly created Experience in storage.
     *
     * @param CreateExperienceRequest $request
     *
     * @return Response
     */
    public function store(CreateExperienceRequest $request)
    {
        $input = $request->all();

        $experience = $this->experienceRepository->create($input);

        Flash::success('Experience saved successfully.');

        return redirect(route('admin.experiences.index'));
    }

    /**
     * Display the specified Experience.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $experience = $this->experienceRepository->findWithoutFail($id);

        if (empty($experience)) {
            Flash::error('Experience not found');

            return redirect(route('experiences.index'));
        }

        return view('admin.experiences.show')->with('experience', $experience);
    }

    /**
     * Show the form for editing the specified Experience.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $experience = $this->experienceRepository->findWithoutFail($id);

        if (empty($experience)) {
            Flash::error('Experience not found');

            return redirect(route('experiences.index'));
        }

        return view('admin.experiences.edit')->with('experience', $experience);
    }

    /**
     * Update the specified Experience in storage.
     *
     * @param  int              $id
     * @param UpdateExperienceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExperienceRequest $request)
    {
        $experience = $this->experienceRepository->findWithoutFail($id);

        

        if (empty($experience)) {
            Flash::error('Experience not found');

            return redirect(route('experiences.index'));
        }

        $experience = $this->experienceRepository->update($request->all(), $id);

        Flash::success('Experience updated successfully.');

        return redirect(route('admin.experiences.index'));
    }

    /**
     * Remove the specified Experience from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.experiences.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Experience::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.experiences.index'))->with('success', Lang::get('message.success.delete'));

       }

}
