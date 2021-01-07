<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\State;
use Validator;
use File;
use Exception;
use Auth;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->where('role', '=', 'user')->get()->sortByDesc('id');
        return view('admin.user.list', compact('users'));
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
        // create the validation rules ----

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => 'required|same:confirm_password|string|min:6',
            'confirm_password' => 'required',
        ]);

        // user profile pic upload code ----

        $profile_pic_name = '';
        if ($request->hasFile('profile_pic')) {
            $profile_pic = $request->file('profile_pic');
            $profile_pic_name = time().'.'.$profile_pic->getClientOriginalExtension();
            $destinationPath = public_path('images/user_images');
            $profile_picPath = $destinationPath. "/".  $profile_pic_name;
            $profile_pic->move($destinationPath, $profile_pic_name);
        }

        // user data save into database ----

        $user = new User;
        $user->profile_pic = $profile_pic_name;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->password = Hash::make($request->password);
        $user->role = "user";
        $user->status = 1;
        $user->save();

        return redirect('admin/dashboard/user')->with('message', 'User Registerd successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('users.id', $id)->where('role', 'user')
                    ->select('users.*','states.name as state', 'states.id as state_id','cities.name as city', 'cities.id as city_id')
                    ->leftJoin('states', 'states.id', '=', 'users.state_id')
                    ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
                    ->first();

        return view('admin.user.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('users.id', $id)->where('role', 'user')
                    ->select('users.*','cities.name as city_name', 'cities.id as city_id')
                    ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
                    ->first();

        $states = State::select('id', 'name')->where('country_id', 101)->get();

        return view('admin.user.edit', compact('user','states'));
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
        // create the validation rules ----
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        //     'password' => 'required|same:confirm_password|string|min:6',
        //     'confirm_password' => 'required',
        // ]);

        // user profile pic upload code ----

        if ($request->hasFile('profile_pic')) {
            $profile_pic = $request->file('profile_pic');
            $profile_pic_name = time().'.'.$profile_pic->getClientOriginalExtension();
            $destinationPath = public_path('images/user_images');
            $profile_picPath = $destinationPath. "/".  $profile_pic_name;
            $profile_pic->move($destinationPath, $profile_pic_name);
       }

        // user data save into database ----

        $user = User::find($id);
        if($request->hasFile('profile_pic') == null){
        }else{
            $user->profile_pic = $profile_pic_name;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->gender = $request->gender;
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;
        $user->pincode = $request->pincode;
        $user->address = $request->address;
        $user->landmark = $request->landmark;


        // $current_password = Auth::User()->password;
        // if(!empty($request->old_password)){
        //     if(Hash::check($request->old_password, $current_password))
        //     {
        //         $user_id = Auth::User()->id;
        //         $obj_user = User::find($user_id);
        //         $obj_user->password = Hash::make($request->password);
        //         $obj_user->save();
        //     }
        //     else
        //     {
        //         return redirect('admin/dashboard/user')->with('error', 'Please enter correct old password.');
        //     }
        // }

        //$user->password = bcrypt($request->password);
        $user->role = "user";
        $user->status = 1;
        $user->save();
        return redirect('admin/dashboard/user')->with('message', 'User Registerd successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $image_path = public_path('/images/user_images/').$user->profile_pic;  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $user->delete();
        return redirect()->back()->with('message', 'User Deleted successfully.');
    }
}
