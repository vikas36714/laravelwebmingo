<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Support;
use App\Models\Feedbacks;
use Exception;

class EnquiryController extends Controller
{
    //--------------------- Contact Page ---------------------//
    public function contact(Type $var = null)
    {
        try {
            $contacts = Contact::orderBy('id', 'DESC')->get();
            return view('admin.enquiry.contact', compact('contacts'));
        }catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //--------------------- Contact Delete ---------------------//
    public function contactDestroy($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->back()->with('message', 'Contact deleted successfully.');
    }


    //--------------------- Support Page ---------------------//
    public function support(Type $var = null)
    {
        try {
            $supports = Support::orderBy('id', 'DESC')->get();
            return view('admin.enquiry.support', compact('supports'));
        }catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //--------------------- Support Delete ---------------------//
    public function supportDestroy($id)
    {
        $support = Support::find($id);
        $support->delete();
        return redirect()->back()->with('message', 'Support deleted successfully.');
    }

    //--------------------- Feedback Page ---------------------//
    public function feedback(Type $var = null)
    {
        try {
            $feedbacks = Feedbacks::orderBy('id', 'DESC')->get();
            return view('admin.enquiry.feedback', compact('feedbacks'));
        }catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //--------------------- Feedback Delete ---------------------//
    public function feedbackDestroy($id)
    {
        $feedback = Feedbacks::find($id);
        $feedback->delete();
        return redirect()->back()->with('message', 'Feedback deleted successfully.');
    }

}
