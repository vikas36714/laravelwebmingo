<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\HowItWorks;
use App\Models\SubCategory;
use Exception;
use File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);

            foreach($categories as $key => $category){
                $subCategory = SubCategory::where('sub_categories.category_id',  $category->id)->select('sub_category_name')->get();
                $categories[$key]['sub_category'] = $subCategory;
                $categories[$key]['sub_category_total'] = $subCategory->count();
            }

        return view('admin.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
        $request->validate([
            'icon' => 'required|mimes:jpg,jpeg,png|max:1000',
            'name' => 'required|string|max:255',
        ]);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $icon_name = time().'.'.$icon->getClientOriginalExtension();
            $destinationPath = public_path('/images/category_images');
            $iconPath = $destinationPath. "/".  $icon_name;
            $icon->move($destinationPath, $icon_name);
       }

        $category = new Category;
        $category->name = $request->name;
        $category->icon = $icon_name;
        $category->slug = $request->slug;
        $category->short_description = $request->short_description;
        $category->reviews_title = $request->reviews_title;
        $category->faq_title = $request->faq_title;
        $category->about_category = $request->about_category;
        $category->status = 1;
        $category->save();
        $categoryid= $category->id;
        if (count($request->title)>0) {
            foreach ($request->title as  $item=>$v)
        {
            $data2 = array('category_id' => $categoryid,
                            'position' => $request->position[$item],
                            'title' => $request->title[$item],
                            'description' => $request->description[$item], );

        HowItWorks::insert($data2);
            }
        }
        return redirect('admin/dashboard/category')->with('message', 'Category created successfully.');
        }catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
        $category = Category::find($id);
        $howItWorks = HowItWorks::where('how_it_works.category_id', $category->id)->get();

        return view('admin.category.edit', compact('category','howItWorks'));
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
        //     'icon' => 'required|mimes:jpg,jpeg,png|max:1000',
        //     'name' => 'required|string',
        // ]);

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $icon_name = time().'.'.$icon->getClientOriginalExtension();
            $destinationPath = public_path('/images/category_images');
            $iconPath = $destinationPath. "/".  $icon_name;
            $icon->move($destinationPath, $icon_name);
       }

        $category = Category::find($id);
        $category->name = $request->name;
        if($request->hasFile('icon') == null){
        }else{
            $category->icon = $icon_name;
        }
        $category->slug = $request->slug;
        $category->short_description = $request->short_description;
        $category->reviews_title = $request->reviews_title;
        $category->faq_title = $request->faq_title;
        $category->about_category = $request->about_category;
        $category->status = 1;
        $category->save();
        $categoryid= $category->id;

        if (count($request->title)>0) {
            $howItWorks = HowItWorks::where('how_it_works.category_id', $categoryid)->get();

                foreach ($howItWorks as $howItWork) {
                    $howItWork->delete();
                }

            foreach ($request->title as  $item=>$v)
            {
                $data2 = array('category_id' => $categoryid,
                            'position' => $request->position[$item],
                            'title' => $request->title[$item],
                            'description' => $request->description[$item], );

                HowItWorks::insert($data2);
            }
        }
        return redirect('admin/dashboard/category')->with('message', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $image_path = public_path('/images/category_images/').$category->icon;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $category->delete();
        return redirect()->back()->with('message', 'Category deleted successfully.');
    }
}
