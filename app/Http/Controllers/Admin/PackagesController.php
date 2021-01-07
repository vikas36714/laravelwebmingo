<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\PackageCategory;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use App\Models\Services;
use App\Models\Packages;
use App\Models\Gallery;
use Exception;
use Illuminate\Support\Str;
use File;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Packages::orderBy('id', 'DESC')
                        ->select('packages.*','package_categories.package_category as package_category_name', 'package_categories.id as package_category_id')
                        ->leftJoin('package_categories', 'packages.package_category_id', '=', 'package_categories.id')
                        ->get();

        foreach($packages as $key => $package){
            $services_ids = array_filter(explode(',', $package->service_id));
            $packages[$key]['services'] = Services::whereIn('id', $services_ids)->select('name')->get();
        }
        return view('admin.packages.list', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id','name')->get();
        $packageCategories = PackageCategory::select('id','package_category')->get();
        //$services = Services::select('id','name', 'amount')->get();

        return view('admin.packages.create', compact('categories','packageCategories'));
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
            'package_category' => 'required',
            'package_name' => 'required',
            ]);

        $package = new Packages;
        $package->category_id = $request->category;
        $package->sub_category_id = $request->sub_category;
        $package->sub_sub_category_id = $request->sub_sub_category ? $request->sub_sub_category : 0;
        $package->package_category_id = $request->package_category;
        $package->name = $request->package_name;
        $package->video = $request->video;
        if(!isset($request->services) || empty($request->services)){
            $services = $request->services = 0;
        }else{
            $services = implode(',', $request->services);
        }
        $package->service_id = $services;
        $package->amount = $request->totalAmount;
        $package->discount = $request->package_discount;
        $package->after_discount = $request->after_discount;
        $package->about_package = $request->about_package;
        $package->status = 1;
        $package->save();
        $packageid= $package->id;

        if ($request->hasFile('gallery_images')) {

            $gallery_images = $request->file('gallery_images');
                foreach ($gallery_images as  $key => $gallery_image){

                    $gallery_image_name = Str::random(32).$gallery_image->getClientOriginalName();
                    $destinationPath = public_path('/images/gallery_images');
                    $gallery_imagePath = $destinationPath. "/".  $gallery_image_name;
                    $gallery_image->move($destinationPath, $gallery_image_name);
                    $data2 = array('package_id' => $packageid,
                                    'image' => $gallery_image_name,);
                    Gallery::insert($data2);
                }
        }

        return redirect('admin/dashboard/packages')->with('message', 'Package Created successfully.');

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
        $subCategories = SubCategory::select('id','sub_category_name')->get();
        $subSubCategories = SubSubCategory::select('id','name')->get();
        $packageCategories = PackageCategory::select('id','package_category')->get();
        $package_images = Gallery::where('galleries.package_id', $id)->select('id','image')->get();

        $packages = Packages::where('packages.id', $id)
                        ->select('packages.*','categories.name as category_name', 'categories.id as category_id','sub_categories.sub_category_name as sub_category_name', 'sub_categories.id as sub_category_id','sub_sub_categories.name as sub_sub_category_name', 'sub_sub_categories.id as sub_sub_category_id','package_categories.package_category as package_category_name', 'package_categories.id as package_category_id')
                        ->leftJoin('categories', 'packages.category_id', '=', 'categories.id')
                        ->leftJoin('sub_categories', 'packages.sub_category_id', '=', 'sub_categories.id')
                        ->leftJoin('sub_sub_categories', 'packages.sub_sub_category_id', '=', 'sub_sub_categories.id')
                        ->leftJoin('package_categories', 'packages.package_category_id', '=', 'package_categories.id')
                        ->first();

        $packages['service_id'] = array_filter(explode(',', $packages->service_id));

        $packages['services'] = Services::whereIn('id', $packages->service_id)->select('*')->get();

        return view('admin.packages.edit', compact('categories','subCategories','subSubCategories','packageCategories','packages','package_images'));
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
            'category' => 'required',
            'sub_category' => 'required',
            'package_category' => 'required',
            'package_name' => 'required',
        ]);

        $package = Packages::find($id);
        $package->category_id = $request->category;
        $package->sub_category_id = $request->sub_category;
        $package->sub_sub_category_id = $request->sub_sub_category;
        $package->package_category_id = $request->package_category;
        $package->name = $request->package_name;
        $package->video = $request->video;
        if(!isset($request->services) || empty($request->services)){
            $services = $request->services = 0;
        }else{
            $services = implode(',', $request->services);
        }
        $package->service_id = $services;

        $package->amount = $request->totalAmount;
        $package->discount = $request->package_discount;
        $package->after_discount = $request->after_discount;
        $package->about_package = $request->about_package;
        $package->status = 1;
        $package->save();
        $packageid= $package->id;
        if($request->hasFile('gallery_images') == null){
        }else{
            $package_images = Gallery::where('galleries.package_id', $packageid)->get();

                foreach ($package_images as $package_image) {
                    $image_path = public_path('/images/gallery_images/').$package_image->image;  // Value is not URL but directory file path
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    $package_image->delete();
                }

            $gallery_images = $request->file('gallery_images');
                foreach ($gallery_images as  $key => $gallery_image){

                    $gallery_image_name = Str::random(32).$gallery_image->getClientOriginalName();
                    $destinationPath = public_path('/images/gallery_images');
                    $gallery_imagePath = $destinationPath. "/".  $gallery_image_name;
                    $gallery_image->move($destinationPath, $gallery_image_name);

                    $data2 = array('package_id' => $packageid,
                                    'image' => $gallery_image_name,
                                    'updated_at' => date("Y-m-d H:i:s"),);
                    Gallery::insert($data2);

                }
        }
        return redirect('admin/dashboard/packages')->with('message', 'Package Updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Packages::find($id);
        $package_images = Gallery::where('package_id', $id)->get();

        foreach($package_images as $package_image){
            $image_path = public_path('/images/gallery_images/').$package_image->image;  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $package_image->delete();
        }

        $package->delete();
        return redirect()->back()->with('message', 'Package deleted successfully.');
    }
}
