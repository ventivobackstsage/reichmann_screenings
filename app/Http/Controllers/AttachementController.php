<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateAttachementRequest;
use App\Http\Requests\UpdateAttachementRequest;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Other;
use App\Repositories\AttachementRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Attachement;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AttachementController extends InfyOmBaseController
{
    /** @var  AttachementRepository */
    private $attachementRepository;

    public function __construct(AttachementRepository $attachementRepo)
    {
        $this->attachementRepository = $attachementRepo;
    }

    /**
     * Display a listing of the Attachement.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
	    if(Sentinel::inRole('admin'))
		    $attachements = $this->attachementRepository->all();
	    elseif (Sentinel::inRole('candidate')){
		    $attachements = Sentinel::getUser()->attachements;
	    }

        return view('admin.attachements.index')
            ->with('attachements', $attachements);
    }

    /**
     * Show the form for creating a new Attachement.
     *
     * @return Response
     */
    public function create()
    {
	    $education = Sentinel::getUser()->candidate->education->pluck('FullName','IdCategory')->toArray();
	    $experience = Sentinel::getUser()->candidate->experience->pluck('FullName','IdCategory')->toArray();
	    $other = Sentinel::getUser()->candidate->other->pluck('name','IdCategory')->toArray();
        return view('admin.attachements.create')
	        ->with('education', $education)
	        ->with('experience', $experience)
	        ->with('other', $other);
    }

    /**
     * Store a newly created Attachement in storage.
     *
     * @param CreateAttachementRequest $request
     *
     * @return Response
     */
    public function store(CreateAttachementRequest $request)
    {

        $input = $request->all();

        $attachement = $this->attachementRepository->create($input);

	    $image = $request->file('image');

	    $input['path'] = $attachement->id.'_'.$image->getClientOriginalName();

	    $destinationPath = public_path('/images/attachements');

	    $image->move($destinationPath, $input['path']);

	    $attachement->path = '/images/attachements/'.$input['path'];

	    list($attachement->imageable_type, $attachement->imageable_id) = explode("_", $request->cat);


	    $attachement->save();

        Flash::success('Attachement saved successfully.');

        return redirect(route('admin.attachements.index'));
    }

    /**
     * Display the specified Attachement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attachement = $this->attachementRepository->findWithoutFail($id);

        if (empty($attachement)) {
            Flash::error('Attachement not found');

            return redirect(route('attachements.index'));
        }

        return view('admin.attachements.show')->with('attachement', $attachement);
    }

    /**
     * Show the form for editing the specified Attachement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attachement = $this->attachementRepository->findWithoutFail($id);

        if (empty($attachement)) {
            Flash::error('Attachement not found');

            return redirect(route('attachements.index'));
        }

        return view('admin.attachements.edit')->with('attachement', $attachement);
    }

    /**
     * Update the specified Attachement in storage.
     *
     * @param  int              $id
     * @param UpdateAttachementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttachementRequest $request)
    {
        $attachement = $this->attachementRepository->findWithoutFail($id);

        

        if (empty($attachement)) {
            Flash::error('Attachement not found');

            return redirect(route('attachements.index'));
        }

        $attachement = $this->attachementRepository->update($request->all(), $id);

        Flash::success('Attachement updated successfully.');

        return redirect(route('admin.attachements.index'));
    }

    /**
     * Remove the specified Attachement from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.attachements.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Attachement::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.attachements.index'))->with('success', Lang::get('message.success.delete'));

       }

}
