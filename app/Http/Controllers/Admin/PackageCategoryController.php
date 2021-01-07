<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\PackageCategory;
use DB;

class PackageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::select('id','name')->get();
        $packageCategories = PackageCategory::orderBy('id', 'DESC')
                            ->select('package_categories.*','category.name as category_name', 'category.id as category_id','sub_category.sub_category_name as sub_category_name', 'sub_category.id as sub_category_id','sub_sub_category.name as sub_sub_category_name','sub_sub_category.id as sub_sub_category_id')
                            ->leftJoin('categories as category', 'package_categories.category_id', '=', 'category.id')
                            ->leftJoin('sub_categories as sub_category', 'package_categories.sub_category_id', '=', 'sub_category.id')
                            ->leftJoin('sub_sub_categories as sub_sub_category', 'package_categories.sub_sub_category_id', '=', 'sub_sub_category.id')
                            ->get();

        return view('admin.package-category.list', compact('categories','packageCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


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
            'package_category' => 'required|string',
        ]);

        $packageCategory = new PackageCategory;
        $packageCategory->category_id = $request->category;
        $packageCategory->sub_category_id = $request->sub_category;
        $packageCategory->sub_sub_category_id = $request->sub_sub_category;
        $packageCategory->package_category = $request->package_category;
        $packageCategory->status = 1;
        $packageCategory->save();

        return redirect('admin/dashboard/package-category')->with('message', 'Package Category Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $packageCategory = PackageCategory::where('package_categories.id', $id)
                            ->select('package_categories.package_category as package_category_name','category.name as category_name', 'sub_category.sub_category_name as sub_category_name', 'sub_sub_category.name as sub_sub_category_name')
                            ->leftJoin('categories as category', 'package_categories.category_id', '=', 'category.id')
                            ->leftJoin('sub_categories as sub_category', 'package_categories.sub_category_id', '=', 'sub_category.id')
                            ->leftJoin('sub_sub_categories as sub_sub_category', 'package_categories.sub_sub_category_id', '=', 'sub_sub_category.id')
                            ->orderBy('package_categories.id', 'DESC')
                            ->first();
        return response()->json($packageCategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['packageCategory'] = PackageCategory::where('package_categories.id', $id)
                        ->select('package_categories.*','category.name as category_name', 'category.id as category_id','sub_category.sub_category_name as sub_category_name', 'sub_category.id as sub_category_id','sub_sub_category.name as sub_sub_category_name','sub_sub_category.id as sub_sub_category_id')
                        ->leftJoin('categories as category', 'package_categories.category_id', '=', 'category.id')
                        ->leftJoin('sub_categories as sub_category', 'package_categories.sub_category_id', '=', 'sub_category.id')
                        ->leftJoin('sub_sub_categories as sub_sub_category', 'package_categories.sub_sub_category_id', '=', 'sub_sub_category.id')
                        ->first();

        $data['categories'] = Category::select('id','name')->get();
        $catHtm = '';

        foreach ($data['categories'] as $key => $category){
            $catHtm .= '<option value="'.$category->id.'" '.(($category->id == $data['packageCategory']->category_id) ? 'selected="selected"':"").'>'.$category->name.'</option>';
            $data['categories'] = $catHtm;


            $data['subCategories'] = SubCategory::where('sub_categories.category_id',$category->id)->select('id','sub_category_name','category_id')->get();
            $subCatHtm = '';
            foreach ($data['subCategories'] as $key => $subCategory){
                $subCatHtm .= '<option value="'.$subCategory->id.'" '.(($subCategory->id == $data['packageCategory']->sub_category_id) ? 'selected="selected"':"").'>'.$subCategory->sub_category_name.'</option>';
                $data['subCategories'] = $subCatHtm;

            }

        }

        // $data['subCategories'] = SubCategory::select('id','sub_category_name','category_id')->get();
        // $subCatHtm = '';
        // foreach ($data['subCategories'] as $key => $subCategory){
        //     $subCatHtm .= '<option value="'.$subCategory->id.'" '.(($subCategory->id == $data['packageCategory']->sub_category_id) ? 'selected="selected"':"").'>'.$subCategory->sub_category_name.'</option>';
        //     $data['subCategories'] = $subCatHtm;

        // }

        $data['subSubCategories'] = SubSubCategory::select('id','name','sub_category_id')->get();
        $subSubCatHtm = '';
        foreach ($data['subSubCategories'] as $key => $subSubCategory){
            $subSubCatHtm .= '<option value="'.$subSubCategory->id.'" '.(($subSubCategory->id == $data['packageCategory']->sub_sub_category_id) ? 'selected="selected"':"").'>'.$subSubCategory->name.'</option>';
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
    public function update(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'sub_category' => 'required',
            'package_category' => 'required|string',
        ]);

        $packageCategory = PackageCategory::find($request->package_category_id);
        $packageCategory->category_id = $request->category;
        $packageCategory->sub_category_id = $request->sub_category;
        if(!isset($request->sub_sub_category) || empty($request->sub_sub_category)){
            $request->sub_sub_category = 0;
        }
        $packageCategory->sub_sub_category_id = $request->sub_sub_category;
        $packageCategory->package_category = $request->package_category;
        $packageCategory->status = 1;
        $packageCategory->save();

        return redirect('admin/dashboard/package-category')->with('message', 'Package Category Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $packageCategory = PackageCategory::find($id);
        $packageCategory->delete();
        return redirect()->back()->with('message', 'Package Category Deleted successfully.');
    }
}
