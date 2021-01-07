<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\TermCondition;
use App\Models\PrivacyPolicy;
use App\Models\RefundCancellation;

class ContentsController extends Controller
{
    //--------------------- About Page ---------------------//
    public function about()
    {
        $pageTitle = 'About Main';

        $about = About::where('abouts.id', 1)->first();
        return view('admin.contents.about', compact('pageTitle', 'about'));
    }

    //--------------------- About Page Update ---------------------//
    public function updateAbout(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/about_images');
            $imagePath = $destinationPath. "/".  $image_name;
            $image->move($destinationPath, $image_name);
        }

       if ($request->hasFile('section3_image')) {
            $section3_image = $request->file('section3_image');
            $section3_image_name = time().'.'.$section3_image->getClientOriginalExtension();
            $destinationPath = public_path('images/about_images');
            $imagePath = $destinationPath. "/".  $section3_image_name;
            $section3_image->move($destinationPath, $section3_image_name);
        }

        // about data update database ----

        $about = About::find($id);
        if($request->hasFile('image') == null){
        }else{ $about->image = $image_name; }
        $about->heading = $request->heading;
        $about->short_description = $request->short_description;
        $about->description = $request->description;
        $about->section1_heading = $request->section1_heading;
        $about->section1_description = $request->section1_description;
        $about->section2_heading = $request->section2_heading;
        $about->section2_description = $request->section2_description;
        if($request->hasFile('section3_image') == null){
        }else{ $about->section3_image = $section3_image_name; }
        $about->section3_heading = $request->section3_heading;
        $about->section3_description = $request->section3_description;
        $about->updated_at = date("Y-m-d H:i:s");
        $about->save();
        return redirect('admin/dashboard/about')->with('message', 'About Content Updated.');
    }


    //--------------------- Terms And Conditions Page ---------------------//
    public function termsAndConditions()
    {
        $pageTitle = 'Terms & Conditions';
        $termConditions = TermCondition::where('term_conditions.id', 1)->first();

        return view('admin.contents.terms-conditions', compact('pageTitle', 'termConditions'));
    }

    //--------------------- Term And Condition Page Update ---------------------//
    public function updateTermAndCondition(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/term_condition_image');
            $imagePath = $destinationPath. "/".  $image_name;
            $image->move($destinationPath, $image_name);
        }

        // term & condition update database ----

        $termCondition = TermCondition::find($id);
        if($request->hasFile('image') == null){
        }else{ $termCondition->image = $image_name; }
        $termCondition->heading = $request->heading;
        $termCondition->short_description = $request->short_description;
        $termCondition->description = $request->description;
        $termCondition->updated_at = date("Y-m-d H:i:s");
        $termCondition->save();
        return redirect('admin/dashboard/terms-conditions')->with('message', 'Term And Condition Content Updated.');
    }

    //--------------------- Privacy Policy Page ---------------------//
    public function privacyPolicy()
    {
        $pageTitle = 'Privacy Policy';
        $privacyPolicies = PrivacyPolicy::where('privacy_policies.id', 1)->first();

        return view('admin.contents.privacy-policy', compact('pageTitle', 'privacyPolicies'));
    }

    //--------------------- Privacy Policy Page Update ---------------------//
    public function updatePrivacyPolicy(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/privacy_policy_image');
            $imagePath = $destinationPath. "/".  $image_name;
            $image->move($destinationPath, $image_name);
        }

        // Privacy Policy update database ----

        $privacyPolicy = PrivacyPolicy::find($id);
        if($request->hasFile('image') == null){
        }else{ $privacyPolicy->image = $image_name; }
        $privacyPolicy->heading = $request->heading;
        $privacyPolicy->short_description = $request->short_description;
        $privacyPolicy->description = $request->description;
        $privacyPolicy->updated_at = date("Y-m-d H:i:s");
        $privacyPolicy->save();
        return redirect('admin/dashboard/privacy-policy')->with('message', 'Privacy Policy Content Updated.');
    }

    //--------------------- Refund And Cancellation Page ---------------------//
    public function refundAndCancellation()
    {
        $pageTitle = 'Refund & Cancellation';
        $refundCancellations = RefundCancellation::where('refund_cancellations.id', 1)->first();

        return view('admin.contents.refund-cancellation', compact('pageTitle', 'refundCancellations'));
    }

    //--------------------- Refund And Cancellation Page update ---------------------//
    public function updateRefundAndCancellation(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('images/refund_cancellation_image');
            $imagePath = $destinationPath. "/".  $image_name;
            $image->move($destinationPath, $image_name);
        }

        // Refund-Cancellation update database ----

        $refundCancellation = RefundCancellation::find($id);
        if($request->hasFile('image') == null){
        }else{ $refundCancellation->image = $image_name; }
        $refundCancellation->heading = $request->heading;
        $refundCancellation->short_description = $request->short_description;
        $refundCancellation->description = $request->description;
        $refundCancellation->updated_at = date("Y-m-d H:i:s");
        $refundCancellation->save();
        return redirect('admin/dashboard/refund-cancellation')->with('message', 'Refund Cancellation Content Updated.');
    }

}
