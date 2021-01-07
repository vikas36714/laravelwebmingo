<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Exception;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('id', 'DESC')->paginate(10);

        return view('admin.contents.faq', compact('faqs'));
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
        try {
            $request->validate([
                'question' => 'required|string',
                'answer' => 'required|string',
            ]);

            $faq = new Faq;
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->status = 1;
            $faq->save();

            return redirect('admin/dashboard/faq')->with('message', 'FAQs Created successfully.');
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
        $faq = Faq::where('id', $id)->select('faqs.answer')->first();
        return response()->json($faq);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = Faq::where('id', $id)->select('faqs.id','faqs.question','faqs.answer')->first();
        return response()->json($faq);
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
        try {
            $faq = Faq::find($request->faq_id);
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->status = 1;
            $faq->save();

            return redirect('admin/dashboard/faq')->with('message', 'FAQs Updated successfully.');
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
        $faq = Ff::find($id);
        $faq->delete();
        return redirect()->back()->with('message', 'FAQs Deleted successfully.');
    }
}
