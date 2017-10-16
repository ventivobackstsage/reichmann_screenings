<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Company;
use App\Models\Update;
use App\Repositories\OrderRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use ConsoleTVs\Invoices\Classes\Invoice;
use PDF;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Order;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

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

        $this->orderRepository->pushCriteria(new RequestCriteria($request));
        $orders = array();
        if(Sentinel::inRole('admin'))
            $orders = $this->orderRepository->all();
	    elseif (Sentinel::inRole('company')){
		    $orders = Sentinel::getUser()->company->orders;
	    }

        return view('admin.orders.index')
            ->with('orders', $orders);
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

        return $pdf->download('order'.$id.'.pdf');
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

        $invoice = Invoice::make()
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


        //return $pdf->download('order'.$id.'.pdf');
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
