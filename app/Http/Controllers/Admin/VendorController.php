<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Services;
use App\Models\User;
use Illuminate\Support\Str;
use File;
use Exception;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = User::orderBy('id', 'DESC')
                        ->where('role','vendor')
                        ->select('id','first_name','last_name','profile_pic','email','mobile_number','role','status','created_at','updated_at')
                        ->get();

        return view('admin.vendor.list', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::select('id','name')->get();
        $categories = Category::select('id','name')->get();
        $subCategories = SubCategory::select('id','sub_category_name')->get();
        $services = Services::select('id','name')->get();

        return view('admin.vendor.create', compact('countries','categories','subCategories','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            //'full_address' => 'required',
            'pincode' => 'required',
            //'email' => 'required|string|email|max:255|unique:users',
            // 'account_type' => 'required',
            // 'account_name' => 'required',
            // 'account_number' => 'required',
            // 'ifsc_code' => 'required',
            // 'bank_name' => 'required',
            // 'bank_branch' => 'required',
            // 'pan_card_number' => 'required|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
            // 'ifsc_code' => 'required|regex:/^[A-Za-z]{4}\d{7}$/',
        ]);

        $pan_card_document_name = '';
        if ($request->hasFile('pan_card_document')) {
            $pan_card_document = $request->file('pan_card_document');
            $pan_card_document_name = Str::random(32).'.'.$pan_card_document->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $pan_card_document_name;
            $pan_card_document->move($destinationPath, $pan_card_document_name);
        }

        $aadhaar_card_front_img_name = '';
        if ($request->hasFile('aadhaar_card_front_img')) {
            $aadhaar_card_front_img = $request->file('aadhaar_card_front_img');
            $aadhaar_card_front_img_name = Str::random(32).'.'.$aadhaar_card_front_img->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $aadhaar_card_front_img_name;
            $aadhaar_card_front_img->move($destinationPath, $aadhaar_card_front_img_name);
        }

        $aadhaar_card_back_img_name = '';
        if ($request->hasFile('aadhaar_card_back_img')) {
            $aadhaar_card_back_img = $request->file('aadhaar_card_back_img');
            $aadhaar_card_back_img_name = Str::random(32).'.'.$aadhaar_card_back_img->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $aadhaar_card_back_img_name;
            $aadhaar_card_back_img->move($destinationPath, $aadhaar_card_back_img_name);
        }

        $cancelled_cheque_img_name = '';
        if ($request->hasFile('cancelled_cheque_img')) {
            $cancelled_cheque_img = $request->file('cancelled_cheque_img');
            $cancelled_cheque_img_name = Str::random(32).'.'.$cancelled_cheque_img->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $cancelled_cheque_img_name;
            $cancelled_cheque_img->move($destinationPath, $cancelled_cheque_img_name);
        }

        $photographs_name = '';
        if ($request->hasFile('photographs')) {
            $photographs = $request->file('photographs');
            $photographs_name = Str::random(32).'.'.$photographs->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $photographs_name;
            $photographs->move($destinationPath, $photographs_name);
        }

        $other_documents_name = '';
        if ($request->hasFile('other_documents')) {
            $other_documents = $request->file('other_documents');
            $other_documents_name = Str::random(32).'.'.$other_documents->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $other_documents_name;
            $other_documents->move($destinationPath, $other_documents_name);
        }

        $business_proof_document_name = '';
        if ($request->hasFile('business_proof_document')) {
            $business_proof_document = $request->file('business_proof_document');
            $business_proof_document_name = Str::random(32).'.'.$business_proof_document->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $business_proof_document_name;
            $business_proof_document->move($destinationPath, $business_proof_document_name);
        }

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->business_type = $request->business_type;
        $user->email = $request->email;
        $user->website = $request->website;
        $user->referral_id = $request->referral_id;
        $user->country_id = $request->country;
        $user->state_id = $request->state;
        $user->city_id = $request->city;
        $user->full_address = $request->full_address;
        $user->pincode = $request->pincode;
        $user->pan_card_number = $request->pan_card_number;

        $user->pan_card_document = $pan_card_document_name;
        $user->aadhaar_card_front = $aadhaar_card_front_img_name;
        $user->aadhaar_card_back = $aadhaar_card_back_img_name;
        $user->business_proof_document = $business_proof_document_name;
        $user->cancelled_cheque_img = $cancelled_cheque_img_name;
        $user->photographs = $photographs_name;
        $user->other_documents = $other_documents_name;

        $user->aadhaar_card_number = $request->aadhaar_card_number;
        $user->business_proof_number = $request->business_proof_number;
        $user->business_address = $request->business_address;
        $user->account_type = $request->account_type;
        $user->account_name = $request->account_name;
        $user->account_number = $request->account_number;
        $user->ifsc_code = $request->ifsc_code;
        $user->bank_name = $request->bank_name;
        $user->bank_branch = $request->bank_branch;
        if(!isset($request->category) || empty($request->category)){
            $category = $request->category = 0;
        }else{
            $category = implode(',', $request->category);
        }
        $user->category_id = $category;

        if(!isset($request->sub_category) || empty($request->sub_category)){
            $sub_category = $request->sub_category = 0;
        }else{
            $sub_category = implode(',', $request->sub_category);
        }
        $user->sub_category_id = $sub_category;

        if(!isset($request->services) || empty($request->services)){
            $services = $request->services = 0;
        }else{
            $services = implode(',', $request->services);
        }
        $user->service_id = $services;
        $city = City::where('id', $request->city)->select('name')->first();
        // Generating Vendor Id.
        $vendor_id = IdGenerator::generate([
                    'table' => 'users', 'field' =>'vendor_id' , 'length' => 12, 'prefix' => 'ST-'.strtoupper(substr ($city->name,'0' ,4)).'-', 'reset_on_prefix_change'=>true
            ]);

        $user->vendor_id = $vendor_id;
        $user->role = "vendor";
        $user->status = 1;
        $user->save();

        return redirect('admin/dashboard/vendor')->with('message', 'Vendor Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendor = User::where('role','vendor')
                        ->where('users.id', $id)
                        ->select('users.*','countries.name as country', 'states.name as state','cities.name as city')
                        ->leftJoin('countries', 'countries.id', '=', 'users.country_id')
                        ->leftJoin('states', 'states.id', '=', 'users.state_id')
                        ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
                        ->first();

        $categories_id = array_filter(explode(',', $vendor->category_id));
        $vendor['categories'] = Category::whereIn('id', $categories_id)->select('name')->get();

        $sub_categories_id = array_filter(explode(',', $vendor->sub_category_id));
        $vendor['sub_categories'] = SubCategory::whereIn('id', $sub_categories_id)->select('sub_category_name as name')->get();

        $services_id = array_filter(explode(',', $vendor->service_id));
        $vendor['services'] = Services::whereIn('id', $services_id)->select('name')->get();

        return view('admin.vendor.view', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = User::where('role','vendor')
                        ->where('users.id', $id)
                        ->select('*')
                        ->first();

        $countries = Country::select('id','name')->get();
        $states = State::where('states.country_id', $vendor->country_id)->select('id','name')->get();
        $cities = City::where('cities.state_id', $vendor->state_id)->select('id','name')->get();

        $categories = Category::select('id','name')->get();

        $subCategories = SubCategory::select('id','sub_category_name as name')->get();
        $services = Services::select('id','name')->get();

        $vendor['categories_id'] = array_filter(explode(',', $vendor->category_id));
        $vendor['sub_categories_id'] = array_filter(explode(',', $vendor->sub_category_id));
        $vendor['services_id'] = array_filter(explode(',', $vendor->service_id));

        return view('admin.vendor.edit', compact('vendor','countries','states','cities','categories','subCategories','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
        if ($request->hasFile('pan_card_document')) {
            $pan_card_document = $request->file('pan_card_document');
            $pan_card_document_name = Str::random(32).'.'.$pan_card_document->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $pan_card_document_name;
            $pan_card_document->move($destinationPath, $pan_card_document_name);
        }

        if ($request->hasFile('aadhaar_card_front_img')) {
            $aadhaar_card_front_img = $request->file('aadhaar_card_front_img');
            $aadhaar_card_front_img_name = Str::random(32).'.'.$aadhaar_card_front_img->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $aadhaar_card_front_img_name;
            $aadhaar_card_front_img->move($destinationPath, $aadhaar_card_front_img_name);
        }

        if ($request->hasFile('aadhaar_card_back_img')) {
            $aadhaar_card_back_img = $request->file('aadhaar_card_back_img');
            $aadhaar_card_back_img_name = Str::random(32).'.'.$aadhaar_card_back_img->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $aadhaar_card_back_img_name;
            $aadhaar_card_back_img->move($destinationPath, $aadhaar_card_back_img_name);
        }

        if ($request->hasFile('cancelled_cheque_img')) {
            $cancelled_cheque_img = $request->file('cancelled_cheque_img');
            $cancelled_cheque_img_name = Str::random(32).'.'.$cancelled_cheque_img->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $cancelled_cheque_img_name;
            $cancelled_cheque_img->move($destinationPath, $cancelled_cheque_img_name);
        }

        if ($request->hasFile('photographs')) {
            $photographs = $request->file('photographs');
            $photographs_name = Str::random(32).'.'.$photographs->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $photographs_name;
            $photographs->move($destinationPath, $photographs_name);
        }

        if ($request->hasFile('other_documents')) {
            $other_documents = $request->file('other_documents');
            $other_documents_name = Str::random(32).'.'.$other_documents->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $other_documents_name;
            $other_documents->move($destinationPath, $other_documents_name);
        }

        if ($request->hasFile('business_proof_document')) {
            $business_proof_document = $request->file('business_proof_document');
            $business_proof_document_name = Str::random(32).'.'.$business_proof_document->getClientOriginalExtension();
            $destinationPath = public_path('images/vendor_images');
            $vendorPath = $destinationPath. "/".  $business_proof_document_name;
            $business_proof_document->move($destinationPath, $business_proof_document_name);
        }

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->business_type = $request->business_type;
        $user->email = $request->email;
        $user->website = $request->website;
        $user->referral_id = $request->referral_id;
        $user->country_id = $request->country;
        $user->state_id = $request->state;
        $user->city_id = $request->city;
        $user->full_address = $request->full_address;
        $user->pincode = $request->pincode;
        $user->pan_card_number = $request->pan_card_number;

        if($request->hasFile('pan_card_document') == null){
        }else{
            $user->pan_card_document = $pan_card_document_name;
        }
        if($request->hasFile('aadhaar_card_front_img') == null){
        }else{
            $user->aadhaar_card_front = $aadhaar_card_front_img_name;
        }
        if($request->hasFile('aadhaar_card_back_img') == null){
        }else{
            $user->aadhaar_card_back = $aadhaar_card_back_img_name;
        }
        if($request->hasFile('business_proof_document') == null){
        }else{
            $user->business_proof_document = $business_proof_document_name;
        }
        if($request->hasFile('cancelled_cheque_img') == null){
        }else{
            $user->cancelled_cheque_img = $cancelled_cheque_img_name;
        }
        if($request->hasFile('photographs') == null){
        }else{
            $user->photographs = $photographs_name;
        }
        if($request->hasFile('other_documents') == null){
        }else{
            $user->other_documents = $other_documents_name;
        }

        $user->aadhaar_card_number = $request->aadhaar_card_number;
        $user->business_proof_number = $request->business_proof_number;
        $user->business_address = $request->business_address;
        $user->account_type = $request->account_type;
        $user->account_name = $request->account_name;
        $user->account_number = $request->account_number;
        $user->ifsc_code = $request->ifsc_code;
        $user->bank_name = $request->bank_name;
        $user->bank_branch = $request->bank_branch;
        if(!isset($request->category) || empty($request->category)){
            $category = $request->category = 0;
        }else{
            $category = implode(',', $request->category);
        }
        $user->category_id = $category;

        if(!isset($request->sub_category) || empty($request->sub_category)){
            $sub_category = $request->sub_category = 0;
        }else{
            $sub_category = implode(',', $request->sub_category);
        }
        $user->sub_category_id = $sub_category;

        if(!isset($request->services) || empty($request->services)){
            $services = $request->services = 0;
        }else{
            $services = implode(',', $request->services);
        }
        $user->service_id = $services;
        // $user->category_id = implode(',', $request->category);
        // $user->sub_category_id = implode(',', $request->sub_category);
        // $user->service_id = implode(',', $request->services);
        $user->vendor_id = $request->vendor_id;
        $user->role = "vendor";
        $user->status = 1;
        $user->save();

        return redirect('admin/dashboard/vendor')->with('message', 'Vendor Updated successfully.');
        }catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = User::find($id);
        $image_path = public_path('/images/vendor_images/').$vendor->profile_pic;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $vendor->delete();
        return redirect()->back()->with('message', 'Vendor Deleted successfully.');
    }
}
