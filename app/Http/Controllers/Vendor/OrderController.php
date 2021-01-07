<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DataTables;
use App\Models\Packages;
use App\Models\Services;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::orderBy('id', 'DESC')
                        ->select('orders.*','users.name','users.email','users.pincode','users.first_name','users.last_name','users.email')
                        ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                        ->get();

            return Datatables::of($orders)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $actionBtn = "<ul class='action'>
                                            <li><a href='#' title='Edit Lead'><i class='fas fa-pencil-alt'></i></a></li>
                                            <li><a href='".route('vendor.manage-order-status',$row->id)."' title='Order Status'><i class='fas fa-history'></i></a></li>
                                            <li><a href='#' title='Delete Lead'><i class='fas fa-trash'></i></a></li>
                                    </ul>";
                            return $actionBtn;
                    })
                    ->editColumn('user', function($row) {
                        return "<td>".$row->name."<br>"
                        .$row->email."<br>"
                        .$row->pincode."</td>";
                    })
                    ->editColumn('package', function($row) {
                        $data = json_decode(json_encode($row->cart_details, true));

                        //return $data;
                        return "<a href='#' id='package_details' data-id='1' data-target='#package-info' data-toggle='modal'>".$data."</a>";
                        // return "<a href='#' id='package_details' data-id='".$data['package']['package_id']."' data-target='#package-info' data-toggle='modal'>".$data['package']['name']."</a>";
                    })
                    ->editColumn('payment_status', function($row) {
                       $tt = json_decode($row->payment_status);
                        return "<span class=''>".$tt."</span>";
                    })
                    ->editColumn('order_status', function($row) {
                        $class = ($row->order_status == 'Pending') ? "badge badge-secondary" : (($row->order_status == 'Processing')  ? "badge badge-warning" : (($row->order_status == 'Completed')  ? "badge badge-success" : "other"));
                        return "<span class='".$class."'>".$row->order_status."</span>";
                    })
                    ->rawColumns(['action','user','package','payment_status','order_status'])
                    ->make(true);
        }
        return view('vendor.order.manage-order');
    }

    //--------------------- GET PACKAGE DETAILS ------------------------//
    public function getPackageDetails(Request $request)
    {
        //$request->package_id//
        $package = Packages::where('packages.id', 1)
                            ->select('packages.*','categories.name as category_name', 'categories.id as category_id','sub_categories.sub_category_name as sub_category_name', 'sub_categories.id as sub_category_id','sub_sub_categories.name as sub_sub_category_name', 'sub_sub_categories.id as sub_sub_category_id')
                            ->leftJoin('categories', 'packages.category_id', '=', 'categories.id')
                            ->leftJoin('sub_categories', 'packages.sub_category_id', '=', 'sub_categories.id')
                            ->leftJoin('sub_sub_categories', 'packages.sub_sub_category_id', '=', 'sub_sub_categories.id')
                            ->first();
        $package['service_id'] = array_filter(explode(',', $package->service_id));

        $package['services'] = Services::whereIn('id', $package->service_id)
                                ->select('services.name as service_name','services.amount as service_amount')->get();
        return response()->json($package);
    }
}
