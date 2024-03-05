<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findorFail($id);
        if($order->coupon != 'No Promo'){
            $coupon = Coupon::where('code', $order->coupon)->first();
            
        }
        $coupon = null;
        return view('admin.order.show', compact('order','coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findorFail($id);
        $order->orderItems()->delete();
        $order->transaction()->delete();
        $order->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function globalOrder(OrderDataTable $dataTable){

        $region = "Global";
        $dataTable->setRegion($region);
        return $dataTable->render('admin.order.globalOrder');
    }

    public function malayOrder(OrderDataTable $dataTable){

        $region = "Malaysia";
        $dataTable->setRegion($region);
        return $dataTable->render('admin.order.malayOrder');
    }

    public function pendingOrder(OrderDataTable $dataTable){

        $order_status = "pending";
        $dataTable->setOrderStatus($order_status);
        return $dataTable->render('admin.order.pendingOrder');
    }

    public function processingOrder(OrderDataTable $dataTable){

        $order_status = "processing";
        $dataTable->setOrderStatus($order_status);
        return $dataTable->render('admin.order.processingOrder');
    }

    public function holdOrder(OrderDataTable $dataTable){

        $order_status = "on hold";
        $dataTable->setOrderStatus($order_status);
        return $dataTable->render('admin.order.holdOrder');
    }

    public function deliveredOrder(OrderDataTable $dataTable){

        $order_status = "delivered";
        $dataTable->setOrderStatus($order_status);
        return $dataTable->render('admin.order.holdOrder');
    }

    public function completedOrder(OrderDataTable $dataTable){

        $order_status = "completed";
        $dataTable->setOrderStatus($order_status);
        return $dataTable->render('admin.order.completedOrder');
    }

    public function cancelledOrder(OrderDataTable $dataTable){

        $order_status = "cancelled";
        $dataTable->setOrderStatus($order_status);
        return $dataTable->render('admin.order.cancelledOrder');
    }

    public function refundedOrder(OrderDataTable $dataTable){

        $order_status = "refunded";
        $dataTable->setOrderStatus($order_status);
        return $dataTable->render('admin.order.refundedOrder');
    }

    public function failedOrder(OrderDataTable $dataTable){

        $order_status = "failed";
        $dataTable->setOrderStatus($order_status);
        return $dataTable->render('admin.order.failedOrder');
    }

    public function returnedOrder(OrderDataTable $dataTable){

        $order_status = "returned";
        $dataTable->setOrderStatus($order_status);
        return $dataTable->render('admin.order.returnedOrder');
    }

    public function changeOrderStatus(Request $request){
        $order = Order::findorFail($request->id);
        $order->order_status = $request->status;
        $order->save();

        return response(['status'=> 'success', 'message' => 'Updated Order Status Successfully']);
    }

    public function changePaymentStatus(Request $request){
        $order = Order::findorFail($request->id);
        $order->payment_status = $request->status;
        $order->save();

        return response(['status'=> 'success', 'message' => 'Updated Payment Status Successfuly']);
    }
}
