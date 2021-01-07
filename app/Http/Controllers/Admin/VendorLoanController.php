<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VendorLoan;
use Exception;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class VendorLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendorLoans = VendorLoan::orderBy('id', 'DESC')->get();

        return view('admin.vendor.vendor-loan', compact('vendorLoans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'loan_amount' => 'required',
        // ]);

        $vendorLoan = new VendorLoan;
        // Generating Loan Id.
        $loan_id = IdGenerator::generate([
                'table' => 'vendor_loans', 'field' =>'loan_id' , 'length' => 12, 'prefix' => 'ST-LOAN-', 'reset_on_prefix_change'=>true
        ]);
        $vendorLoan->loan_id = $loan_id;
        $vendorLoan->vendor_id = $request->vendor_id;
        $vendorLoan->loan_amount = $request->loan_amount;
        if(!isset($request->deduction) || empty($request->deduction)){
            $request->deduction = 0;
        }
        $vendorLoan->deduction = $request->deduction;
        if(!isset($request->loan_remaining) || empty($request->loan_remaining)){
            $request->loan_remaining = 0;
        }
        $vendorLoan->loan_remaining = $request->loan_remaining;
        $vendorLoan->loan_details = $request->loan_details;
        $vendorLoan->status = 'pending';
        $saved = $vendorLoan->save();
        if(!$saved){
            return false;
        }
        return true;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vendor_id)
    {
        $vendor = User::where('role','vendor')
                        ->where('users.vendor_id', $vendor_id)
                        ->select(DB::raw("CONCAT(users.first_name,' ',users.last_name) as name"),'email','mobile_number','address','pincode','states.name as state','cities.name as city')
                        ->leftJoin('states', 'states.id', '=', 'users.state_id')
                        ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
                        ->first();

       return response()->json($vendor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($loan_id)
    {
        $data['vendorLoan'] = VendorLoan::where('vendor_loans.loan_id', $loan_id)
                        ->select('vendor_loans.*', DB::raw("CONCAT(users.first_name,' ',users.last_name) as name"),'email')
                        ->leftJoin('users', 'users.vendor_id', '=', 'vendor_loans.vendor_id')
                        ->first();
        $data['vendorDetails'] = User::where('vendor_id', $data['vendorLoan']->vendor_id)
                        ->select('states.name as state','cities.name as city')
                        ->leftJoin('states', 'states.id', '=', 'users.state_id')
                        ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
                        ->first();
       
       return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $vendorLoan = VendorLoan::where('loan_id', $request->loan_id)->first();
        $vendorLoan->vendor_id = $request->vendor_id;
        $vendorLoan->loan_amount = $request->loan_amount;

        $vendorLoan->deduction = $request->deduction;
        if(empty($request->loan_remaining)){           
        }else {
            $vendorLoan->loan_remaining = $request->loan_remaining;
        }        
        $vendorLoan->loan_details = $request->loan_details;
        $vendorLoan->status = 'pending';
        $saved = $vendorLoan->save();
        if(!$saved){
            return false;
        }
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //------------ Check Vendor is exist or Not ---------------//

    public function checkVendorExist(Request $request)
    {
        $vendor = User::where('role','vendor')
                        ->where('users.vendor_id', $request->vendor_id)
                        ->select('first_name','last_name','email','states.name as state','cities.name as city')
                        ->leftJoin('states', 'states.id', '=', 'users.state_id')
                        ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
                        ->first();
        return $vendor;
    }

}
