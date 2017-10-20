<?php

namespace App\Http\Controllers;

use App\Classes\SmartBillCloudRestClientClass;
use App\Http\Requests;
use App\Http\Requests\CreateCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Mail\Restore;
use App\Models\Order;
use App\Repositories\CandidateRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Candidate;
use Flash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Carbon\Carbon;
use stdClass;

class CandidateController extends InfyOmBaseController
{
    /** @var  CandidateRepository */
    private $candidateRepository;

    public function __construct(CandidateRepository $candidateRepo)
    {
        $this->candidateRepository = $candidateRepo;
    }

    /**
     * Display a listing of the Candidate.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->candidateRepository->pushCriteria(new RequestCriteria($request));
        if(Sentinel::inRole('admin')) 
            $candidates = $this->candidateRepository->all();
        elseif (Sentinel::inRole('company')){
            $collection = Sentinel::getUser()->company->orders->map(function($order){
                return $order->candidate_id;
            });
            $candidates = $this->candidateRepository->findWhereIn('id',$collection->toArray());
        }

	    //dd($candidates[0]->user->first_name);
        
        return view('admin.candidates.index')
            ->with('candidates', $candidates);
    }

    /**
     * Show the form for creating a new Candidate.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.candidates.create');
    }

    /**
     * Store a newly created Candidate in storage.
     *
     * @param CreateCandidateRequest $request
     *
     * @return Response
     */
    public function store(CreateCandidateRequest $request)
    {
	    //check whether use should be activated by default or not
	    $activate = false;

	    try {
		    // Register the user
		    $user = Sentinel::register(['email'=>$request->get('email'),'password'=>$request->get('password')], $activate);

		    $user->first_name = $request->get('first_name');
		    $user->last_name = $request->get('last_name');
		    $user->phone = $request->get('phone');
		    $user->save();

		    //add user to 'User' group
		    $role = Sentinel::findRoleById($request->get('group'));
		    if ($role) {
			    $role->users()->attach($user);
		    }

		    $input = $request->except('_token', 'first_name', 'last_name', 'password', 'email', 'password_confirm', 'group', 'activate', 'position', 'reason', 'phone');

		    $input['user_id'] = $user->id;

		    $candidate = $this->candidateRepository->create($input);

		    $order = array();
		    $order['position'] = $request->get('position');
		    $order['reason'] = $request->get('reason');
		    $order['candidate_id'] = $candidate->id;
		    $order['company_id'] = Sentinel::getUser()->company->id;
		    $order['status'] = 'pending';

		    $order = Order::create($order);

		    $company = Sentinel::getUser()->company;

		    $smartBill = new SmartBillCloudRestClientClass('office@cohen.ro','af3930ccb2c9a7c3e0b24d538f648837');

			$products = array();
			$products[] = array(
				'name'              => $user->fullName,
				'measuringUnitName' => "buc",
				'currency'          => "EUR",
				'quantity'          => 1,
				'price'             => ($order->reason=='fire')?150:(($order->position=='regular')?150:250),
				'isService'         => true

			);

			if($company->discount>0){
				$products[] = array(
					'name'              => "Discount",
					'isDiscount'        => true,
					'measuringUnitName' => "buc",
					'currency'          => "EUR",
					'numberOfItems'     => 1,
					'discountType'      => 2,
					'discountPercentage'=> 10,

				);
			}

		    $invoice = array(
			    'companyVatCode'=> "RO30184266",
			    'client'        => array(
				    'name'          => $company->name,
				    'vatCode'       => $company->vat_code,
				    'regCom'        => $company->reg_com,
				    'phone'         => $company->phone,
				    'address'       => $company->address,
			    ),
			    'seriesName'    => "RAM",
			    'currency'      => "RON",
			    'products'      => $products
			    );

		    try {
    	        $response = $smartBill->createInvoice($invoice);
			    $order->sb_name = $response['series'];
			    $order->sb_number = $response['number'];
			    $order->save();
		    } catch (Exception $ex) {
			    Flash::error($ex->getMessage());
		    }

		    Flash::success('Candidate create! \r\nYour order was placed.');

		    //check for activation and send activation mail if not activated by default
		    if (!$request->get('activate')) {

			    $data = new \stdClass();
			    // Data to be used on the email view
			    $data->user_name =$user->first_name .' '. $user->last_name;
			    $data->activationUrl = URL::route('activate', [$user->id, Activation::create($user)->code]);

			    // Send the activation code through email
			    Mail::to($user->email)->send(new Restore($data));
		    }

		    // Redirect to the home page with success menu
		    return Redirect::route('admin.candidates.index');

	    } catch (LoginRequiredException $e) {
		    $error = trans('admin/users/message.user_login_required');
	    } catch (PasswordRequiredException $e) {
		    $error = trans('admin/users/message.user_password_required');
	    } catch (UserExistsException $e) {
		    $error = trans('admin/users/message.user_exists');
	    }

	    // Redirect to the user creation page
	    return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * Display the specified Candidate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $candidate = $this->candidateRepository->findWithoutFail($id);

        if (empty($candidate)) {
            Flash::error('Candidate not found');

            return redirect(route('candidates.index'));
        }

        return view('admin.candidates.show')->with('candidate', $candidate);
    }

    /**
     * Show the form for editing the specified Candidate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $candidate = $this->candidateRepository->findWithoutFail($id);

        if (empty($candidate)) {
            Flash::error('Candidate not found');

            return redirect(route('candidates.index'));
        }

        return view('admin.candidates.edit')->with('candidate', $candidate);
    }

    /**
     * Update the specified Candidate in storage.
     *
     * @param  int              $id
     * @param UpdateCandidateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCandidateRequest $request)
    {
        $candidate = $this->candidateRepository->findWithoutFail($id);

        

        if (empty($candidate)) {
            Flash::error('Candidate not found');

            return redirect(route('candidates.index'));
        }

        $candidate = $this->candidateRepository->update($request->all(), $id);

        Flash::success('Candidate updated successfully.');

        return redirect(route('admin.candidates.index'));
    }

    /**
     * Remove the specified Candidate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.candidates.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Candidate::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.candidates.index'))->with('success', Lang::get('message.success.delete'));

       }

}
