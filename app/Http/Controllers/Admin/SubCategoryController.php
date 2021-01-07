<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\State;
use App\Models\City;
use App\Models\ManagePinCode;
use File;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategories = SubCategory::orderBy('id', 'DESC')
                        ->select('sub_categories.*','category.name as category_name', 'category.id as category_id')
                        ->leftJoin('categories as category', 'sub_categories.category_id', '=', 'category.id')
                        ->get();
        return view('admin.sub-category.list', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','name')->get();
        $states = State::where('country_id',101)->get();

        return view('admin.sub-category.create', compact('categories','states'));
    }

    //-------------------------- Get States By Country -------------------------//
    public function getStatesByCountry(Request $request)
    {
        $states = State::where("country_id", $request->country_id)->select('name','id')->get();
        return response()->json($states);
    }

    //-------------------------- Get Cities By State -------------------------//
    public function getCitiesByState(Request $request)
    {
        $cities = City::where("state_id",$request->state_id)->select('name','id')->get();
        return response()->json($cities);
    }

    //-------------------------- Get Pincodes By City -------------------------//
    public function getPincodesByCity(Request $request)
    {
        $pincodesByCity = ManagePinCode::where("city_id",$request->city_id)->select('*')->get();
        return response()->json($pincodesByCity);
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
            'sub_category_icon' => 'required|mimes:jpg,jpeg,png',
            'category_id' => 'required|string',
            'sub_category_name' => 'required|string',
        ]);

        if ($request->hasFile('sub_category_icon')) {
            $sub_category_icon = $request->file('sub_category_icon');
            $sub_category_icon_name = time().'.'.$sub_category_icon->getClientOriginalExtension();
            $destinationPath = public_path('images/sub_category_images');
            $sub_category_iconPath = $destinationPath. "/".  $sub_category_icon_name;
            $sub_category_icon->move($destinationPath, $sub_category_icon_name);
       }else {
            dd('No Sub Category icon was found');
        }

        $SubCategory = new SubCategory;
        $SubCategory->category_id = $request->category_id;
        $SubCategory->sub_category_icon = $sub_category_icon_name;
        $SubCategory->sub_category_name = $request->sub_category_name;
        $SubCategory->sub_category_slug = $request->sub_category_slug;
        $SubCategory->short_description = $request->short_description;
        if(!isset($request->features) || empty($request->features)){
            $features = $request->features = 0;
        }else{
            $features = implode(',', $request->features);
        }
        $SubCategory->features = $features;

        if(!isset($request->pincodes) || empty($request->pincodes)){
            $pincodes = $request->pincodes = 0;
        }else{
            $pincodes = implode(',', $request->pincodes);
        }
        $SubCategory->servicable_pincode = $pincodes;
        $SubCategory->meta_title = $request->meta_title;
        $SubCategory->meta_description = $request->meta_description;
        $SubCategory->meta_keyword = $request->meta_keyword;
        $SubCategory->status = 1;
        $SubCategory->save();

        return redirect('admin/dashboard/sub-category')->with('message', 'Sub Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::get();
        $subCategory = SubCategory::where('id', $id)->first();
        $subCategory['features'] = array_filter(explode(',', $subCategory->features));

        return view('admin.sub-category.edit', compact('categories','subCategory'));
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
        $request->validate([
            'category_id' => 'required|string',
            'sub_category_name' => 'required|string',
        ]);

        if ($request->hasFile('sub_category_icon')) {
            $sub_category_icon = $request->file('sub_category_icon');
            $sub_category_icon_name = time().'.'.$sub_category_icon->getClientOriginalExtension();
            $destinationPath = public_path('images/sub_category_images');
            $sub_category_iconPath = $destinationPath. "/".  $sub_category_icon_name;
            $sub_category_icon->move($destinationPath, $sub_category_icon_name);
       }

        $SubCategory = SubCategory::find($id);
        $SubCategory->category_id = $request->category_id;
        if($request->hasFile('sub_category_icon') == null){
        }else{
            $SubCategory->sub_category_icon = $sub_category_icon_name;
        }
        $SubCategory->sub_category_name = $request->sub_category_name;
        $SubCategory->sub_category_slug = $request->sub_category_slug;
        $SubCategory->short_description = $request->short_description;
        if(!isset($request->features) || empty($request->features)){
            $features = $request->features = 0;
        }else{
            $features = implode(',', $request->features);
        }
        $SubCategory->features = $features;
        $SubCategory->meta_title = $request->meta_title;
        $SubCategory->meta_description = $request->meta_description;
        $SubCategory->meta_keyword = $request->meta_keyword;
        $SubCategory->status = 1;
        $SubCategory->save();

        return redirect('admin/dashboard/sub-category')->with('message', 'Sub Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);
        $image_path = public_path('/images/sub_category_images/').$subCategory->sub_category_icon;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $subCategory->delete();
        return redirect()->back()->with('message', 'Sub Category deleted successfully.');
    }
}
