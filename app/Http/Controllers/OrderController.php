<?php

namespace App\Http\Controllers;

use App\Classes\SmartBillCloudRestClientClass;
use App\Facades\SmartBill;
use App\Http\Requests;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Company;
use App\Models\Update;
use App\Repositories\OrderRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use ConsoleTVs\Invoices\Classes\Invoice;
use Illuminate\Support\Facades\Storage;
use PDF;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Order;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Yajra\DataTables\DataTables;

class OrderController extends InfyOmBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Order.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        return view('admin.orders.index');
    }

	/**
	 * Pass data through ajax call
	 * @return mixed
	 */
	public function data()
	{
		//$this->orderRepository->pushCriteria(new RequestCriteria($request));
		$orders = array();
		if(Sentinel::inRole('admin'))
			$orders = $this->orderRepository->all();
		elseif (Sentinel::inRole('company')){
			$orders = Sentinel::getUser()->company->orders;
		}

		return DataTables::of($orders)
			->editColumn('updated_at',function(Order $order) {
				return $order->updated_at->diffForHumans();
			})
			->editColumn('company',function(Order $order) {
				return $order->company->name;
			})
			->editColumn('candidate',function(Order $order) {
				return $order->candidate->user->first_name.' '.$order->candidate->user->last_name;
			})
			->editColumn('email',function(Order $order) {
				return $order->candidate->user->email;
			})
			->addColumn('actions',function($order) {

				$actions = '<a href='. route('admin.orders.show', $order->id) .'><i class="livicon" data-name="edit" data-size="22" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit order"></i></a>
	            <a href='. route('admin.orders.print', $order->id) .' target="_blank"><i class="livicon" data-name="download" data-size="22" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="download order"></i></a>
	            <a href='. route('admin.orders.invoice', $order->id) .' target="_blank"><i class="livicon" data-name="money" data-size="22" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="invoice"></i></a>';

				return $actions;
			})
			->rawColumns(['actions'])
			->make(true);
	}

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        $order = $this->orderRepository->create($input);

        Flash::success('Order saved successfully.');

        return redirect(route('admin.orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('admin.orders.show')->with('order', $order);
    }

    /**
     * Create PDF and print
     *
     * @param  int $id
     *
     * @return Response
     */
    public function print($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $pdf = PDF::loadView('admin.orders.print',['order'=>$order]);

        return $pdf->stream('order'.$id.'.pdf');
	    return view('admin.orders.print')->with('order', $order);

    }

    /**
     * Create invoice and download
     *
     * @param  int $id
     *
     * @return Response
     */
    public function invoice($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }
        
        $price = ($order->reason=='fire')?150:(($order->position=='regular')?150:250);

        /*$invoice = Invoice::make()
                    ->addItem($order->candidate->user->first_name.' '.$order->candidate->user->last_name,$price,1)
                    ->logo(asset('assets/img/logo@2x.png'))
                    ->number($order->id)
                    ->tax(19)
                    ->customer([
                        'name'        => $order->company->name,
                        'phone'       => $order->company->phone,
                        'address'     => $order->company->address,
                        'reg_com'     => $order->company->reg_com,
                        'vat_code'    => $order->company->vat_code,
                    ])
                    ->show('invoice');
*/

        //dd($order->sb_name,$order->sb_number);

	    $smartBill = new SmartBillCloudRestClientClass('office@cohen.ro','af3930ccb2c9a7c3e0b24d538f648837');

	    $pdf = $smartBill->PDFInvoice("RO30184266",$order->sb_name,str_pad($order->sb_number, 4, "0", STR_PAD_LEFT));

	    /*
	    Storage::disk('public')->put('invoice_'.$order->sb_name.str_pad($order->sb_number, 4, "0", STR_PAD_LEFT).'.pdf', $pdf);

	    $file = Storage::disk('local')->get('invoice_'.$order->sb_name.str_pad($order->sb_number, 4, "0", STR_PAD_LEFT).'.pdf');
	    */
	    return response($pdf,200,array('Content-Type' => 'application/pdf', 'Content-Disposition' =>  'inline; filename="invoice.pdf"'));
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('admin.orders.edit')->with('order', $order);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param  int              $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $order = $this->orderRepository->update($request->except('info'), $id);

        $update = new Update;
        $update->order_id = $order->id;
        $update->status = $request->get('status');
        $update->Description = $request->get('info');
        $update->user_id = Sentinel::getUser()->id;
        $update->save();


        Flash::success('Order updated successfully.');

        return redirect(route('admin.orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.orders.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Order::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.orders.index'))->with('success', Lang::get('message.success.delete'));

       }

}
