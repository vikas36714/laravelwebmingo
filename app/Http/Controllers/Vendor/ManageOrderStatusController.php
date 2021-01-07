<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatus;
use DataTables;
use Exception;

class ManageOrderStatusController extends Controller
{
    public function index($id)
    {
        $order = Order::where('orders.id', $id)->orderBy('id', 'DESC')
                        ->select('orders.*','users.name','users.email','users.pincode','users.name','users.email','user_tbl.first_name as vendor_first_name','user_tbl.last_name as vendor_last_name','user_tbl.email as vendor_email','order_statuses.status as order_status')
                        ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                        ->leftJoin('users as user_tbl', 'user_tbl.vendor_id', '=', 'orders.vendor_id')
                        ->leftJoin('order_statuses', 'order_statuses.order_id', '=', 'orders.id')
                        ->first();
        return view('vendor.order.manage-order-status', compact('order'));
    }

    public function store(Request $request)
    {
        try {
            // $request->validate([
            //     'order_status' => 'required|string',
            //     'remark' => 'required|string',
            // ]);

            $faq = new OrderStatus;
            $faq->status = $request->order_status;
            $faq->remark = $request->remark;
            $faq->order_id = $request->order_id;
            $faq->save();

            return redirect()->back()->with('message', 'Order Status Updated Successfully.');
            }catch(Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
    }


}
