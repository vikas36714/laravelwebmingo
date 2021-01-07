<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use File;

class SubSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subSubCategories = SubSubCategory::orderBy('id', 'DESC')
                        ->select('sub_sub_categories.*','category.name as category_name', 'category.id as category_id','sub_category.sub_category_name as sub_category_name', 'sub_category.id as sub_category_id')
                        ->leftJoin('categories as category', 'sub_sub_categories.category_id', '=', 'category.id')
                        ->leftJoin('sub_categories as sub_category', 'sub_sub_categories.sub_category_id', '=', 'sub_category.id')
                        ->get();

        return view('admin.sub-sub-category.list', compact('subSubCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','name')->get();
        return view('admin.sub-sub-category.create', compact('categories'));
    }

    //-------------------------- Get SubCategories By Category Id Method -------------------------//
    public function getSubCategoriesByCategoryId(Request $request)
    {
        $subCategories = SubCategory::where("category_id",$request->category_id)->select('sub_category_name','id','category_id')->get();
        return response()->json($subCategories);
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
            'icon' => 'required|mimes:jpg,jpeg,png',
            'name' => 'required|string',
        ]);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $icon_name = time().'.'.$icon->getClientOriginalExtension();
            $destinationPath = public_path('images/sub_sub_category_images');
            $iconPath = $destinationPath. "/".  $icon_name;
            $icon->move($destinationPath, $icon_name);
       }else {
            dd('No Sub-Sub-Category icon was found');
        }

        $SubSubCategory = new SubSubCategory;
        $SubSubCategory->category_id = $request->category;
        $SubSubCategory->sub_category_id = $request->sub_category;
        $SubSubCategory->icon = $icon_name;
        $SubSubCategory->name = $request->name;
        $SubSubCategory->slug = $request->slug;
        $SubSubCategory->short_description = $request->short_description;
        $SubSubCategory->meta_title = $request->meta_title;
        $SubSubCategory->meta_description = $request->meta_description;
        $SubSubCategory->meta_keyword = $request->meta_keyword;
        $SubSubCategory->status = 1;
        $SubSubCategory->save();

        return redirect('admin/dashboard/sub-sub-category')->with('message', 'Sub Sub Category created successfully.');
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
        $categories = Category::select('id','name')->get();
        $subCategories = SubCategory::select('id','sub_category_name as name')->get();
        $subSubCategory = SubSubCategory::where('id', $id)->first();

        return view('admin.sub-sub-category.edit', compact('categories','subSubCategory','subCategories'));
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
            'category' => 'required|string',
            'name' => 'required|string',
        ]);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $icon_name = time().'.'.$icon->getClientOriginalExtension();
            $destinationPath = public_path('images/sub_sub_category_images');
            $iconPath = $destinationPath. "/".  $icon_name;
            $icon->move($destinationPath, $icon_name);
       }

        $SubSubCategory =  SubSubCategory::find($id);
        $SubSubCategory->category_id = $request->category;
        $SubSubCategory->sub_category_id = $request->sub_category;
        if($request->hasFile('icon') == null){
        }else{
            $SubSubCategory->icon = $icon_name;
        }
        $SubSubCategory->name = $request->name;
        $SubSubCategory->slug = $request->slug;
        $SubSubCategory->short_description = $request->short_description;
        $SubSubCategory->meta_title = $request->meta_title;
        $SubSubCategory->meta_description = $request->meta_description;
        $SubSubCategory->meta_keyword = $request->meta_keyword;
        $SubSubCategory->status = 1;
        $SubSubCategory->save();

        return redirect('admin/dashboard/sub-sub-category')->with('message', 'Sub Sub Category Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subSubCategory = SubSubCategory::find($id);
        $image_path = public_path('/images/sub_sub_category_images/').$subSubCategory->icon;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $subSubCategory->delete();
        return redirect()->back()->with('message', 'Sub Sub Category deleted successfully.');
    }
}
