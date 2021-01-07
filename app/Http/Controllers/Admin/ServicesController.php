<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\PackageCategory;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use App\Models\Services;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::select('id','name')->get();
        $services = Services::orderBy('id', 'DESC')
                            ->select('services.*','category.name as category_name', 'category.id as category_id','sub_category.sub_category_name as sub_category_name', 'sub_category.id as sub_category_id','sub_sub_category.name as sub_sub_category_name','sub_sub_category.id as sub_sub_category_id')
                            ->leftJoin('categories as category', 'services.category_id', '=', 'category.id')
                            ->leftJoin('sub_categories as sub_category', 'services.sub_category_id', '=', 'sub_category.id')
                            ->leftJoin('sub_sub_categories as sub_sub_category', 'services.sub_sub_category_id', '=', 'sub_sub_category.id')
                            ->get();

        return view('admin.services.list', compact('categories','services'));
    }

    //-------------------------- Get Sub-Sub-Categories By SubCategory Id Method -------------------------//

    public function getSubSubCategoriesBySubCategoryId(Request $request)
    {
        $subSubCategories = SubSubCategory::where("sub_category_id",$request->sub_category_id)
                                            ->select('name','id','sub_category_id')->get();
        return response()->json($subSubCategories);
    }

     //-------------------------- Get package categories By subSubCategory Id Method -------------------------//

     public function getPackageCategoriesBySubSubCategory(Request $request)
     {
        $data['packageCategories'] = PackageCategory::where("sub_sub_category_id",$request->sub_sub_category_id)
                            ->select('id','package_category as name','sub_sub_category_id')
                            ->get();

        $data['services'] = Services::where("sub_sub_category_id",$request->sub_sub_category_id)
                            ->select('id','name','after_discount','sub_sub_category_id')
                            ->get();

        return response()->json($data);
     }


    //-------------------------- Get Service Amount By  Method -------------------------//

    public function getServiceAmountByServiceId(Request $request)
    {
        if(isset($request->services_ids)){
            $after_discounts = Services::whereIn('id', $request->services_ids)->select('after_discount')->get();
            $totalAmount = 0;
            foreach($after_discounts as $value) {
                $totalAmount +=  $value->after_discount;
            }
            return $totalAmount;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.services.create');
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
            'category' => 'required',
            'sub_category' => 'required',
            'name' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $services = new Services;
        $services->category_id = $request->category;
        $services->sub_category_id = $request->sub_category;
        if(!isset($request->sub_sub_category) || empty($request->sub_sub_category)){
            $request->sub_sub_category = 0;
        }
        $services->sub_sub_category_id = $request->sub_sub_category;
        $services->name = $request->name;
        $services->amount = $request->amount;
        $services->discount = $request->discount;
        $services->after_discount = $request->after_discount;
        $services->status = 1;
        $services->save();

        return redirect('admin/dashboard/services')->with('message', 'Services Created successfully.');
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
        $data['services'] = Services::where('services.id', $id)
                        ->select('services.*','category.name as category_name', 'category.id as category_id','sub_category.sub_category_name as sub_category_name', 'sub_category.id as sub_category_id','sub_sub_category.name as sub_sub_category_name','sub_sub_category.id as sub_sub_category_id')
                        ->leftJoin('categories as category', 'services.category_id', '=', 'category.id')
                        ->leftJoin('sub_categories as sub_category', 'services.sub_category_id', '=', 'sub_category.id')
                        ->leftJoin('sub_sub_categories as sub_sub_category', 'services.sub_sub_category_id', '=', 'sub_sub_category.id')
                        ->first();
        // $data['categories'] = Category::select('id','name')->get();
        // $data['subCategories'] = SubCategory::select('id','sub_category_name')->get();
        // $data['subSubCategories'] = SubSubCategory::select('id','name')->get();

        $data['categories'] = Category::select('id','name')->get();
        $catHtm = '';

        foreach ($data['categories'] as $key => $category){
            $catHtm .= '<option value="'.$category->id.'" '.(($category->id == $data['services']->category_id) ? 'selected="selected"':"").'>'.$category->name.'</option>';
            $data['categories'] = $catHtm;


            $data['subCategories'] = SubCategory::where('sub_categories.category_id',$category->id)->select('id','sub_category_name','category_id')->get();
            $subCatHtm = '';
            foreach ($data['subCategories'] as $key => $subCategory){
                $subCatHtm .= '<option value="'.$subCategory->id.'" '.(($subCategory->id == $data['services']->sub_category_id) ? 'selected="selected"':"").'>'.$subCategory->sub_category_name.'</option>';
                $data['subCategories'] = $subCatHtm;

            }
        }

        $data['subSubCategories'] = SubSubCategory::select('id','name','sub_category_id')->get();
        $subSubCatHtm = '';
        foreach ($data['subSubCategories'] as $key => $subSubCategory){
            $subSubCatHtm .= '<option value="'.$subSubCategory->id.'" '.(($subSubCategory->id == $data['services']->sub_sub_category_id) ? 'selected="selected"':"").'>'.$subSubCategory->name.'</option>';
            $data['subSubCategories'] = $subSubCatHtm;

        }

        return response()->json($data);
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
        // $request->validate([
        //     'category' => 'required',
        //     'sub_category' => 'required',
        //     'name' => 'required|string',
        //     'amount' => 'required|numeric',
        // ]);

        $services = Services::find($id);
        $services->category_id = $request->category_id;
        $services->sub_category_id = $request->sub_category_id;
        if(!isset($request->sub_sub_category_id) || empty($request->sub_sub_category_id)){
            $request->sub_sub_category_id = 0;
        }
        $services->sub_sub_category_id = $request->sub_sub_category_id;
        $services->name = $request->name;
        $services->amount = $request->amount;
        $services->discount = $request->discount;
        $services->after_discount = $request->after_discount;
        $services->status = 1;
        $services->save();

        return response()->json(['success'=>'Service Updated successfully..']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Services::find($id);
        $service->delete();
        return redirect()->back()->with('message', 'Services deleted successfully.');
    }
}
