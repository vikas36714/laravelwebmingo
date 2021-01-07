<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManagePinCode;
use App\Models\State;
use App\Models\City;
use DataTables;
use DB;
use Exception;

class ManagePinCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
        if ($request->ajax()) {
            $data = State::where('country_id', 101)->select('states.*','states.name as state_name', 'states.id as state_id','city.name as city_name', 'city.id as city_id','manage_pin_codes.pincode','manage_pin_codes.status','manage_pin_codes.updated_at')
            ->leftJoin('cities as city', 'city.state_id', '=', 'states.id')
            ->leftJoin('manage_pin_codes', 'manage_pin_codes.city_id', '=', 'city.id')
            ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $actionBtn = "<ul class='action'>
                                        <li><a href='pincode/edit/".$row->id."'><i class='fas fa-pencil-alt'></i></a></li>
                                        <li><a href=''><i class='fas fa-times'></i></a></li>
                                        <li><a href='./delete/".$row->id."'><i class='fas fa-trash'></i></a></li>
                                    </ul>";
                            return $actionBtn;
                    })
                    ->editColumn('pincode', function($row) {
                        $total_pincodes = ManagePinCode::where('city_id', $row->city_id)->count();

                        return "<a href='#' id='viewpincodes' data-target='#view-pincodes' data-id='".$row->city_id."' data-toggle='modal'>".$total_pincodes."</a>";
                    })
                    ->editColumn('status', function($row) {
                        return ''.$row->status ? '<span class="badge badge-success">Success</span>' : '<span class="badge badge-secondary">Pending</span>'.'';
                    })
                    ->rawColumns(['action','pincode','status'])
                    ->make(true);
        }
            return view('admin.pincode.list');
        }catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
        $pinCode = new ManagePinCode;
        $pinCode->state_id = $request->state_id;
        $pinCode->city_id = $request->city_id;
        $pinCode->pincode = implode(',', (array) $request->pincode);
        $pinCode->status = 1;
        $pinCode->save();
        return response()->json(['success'=>'Pincode added successfully.']);
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
    public function edit(Request $request, $id)
    {

        if ($request->ajax()) {
            $data = State::where('country_id', 101)
            ->where('states.id', $id)
            ->select('states.*','states.name as state_name', 'states.id as state_id','city.name as city_name', 'city.id as city_id','manage_pin_codes.pincode','manage_pin_codes.id as pincode_id','manage_pin_codes.status','manage_pin_codes.updated_at')
            ->leftJoin('cities as city', 'city.state_id', '=', 'states.id')
            ->leftJoin('manage_pin_codes', 'manage_pin_codes.city_id', '=', 'city.id')
            ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $actionBtn = "<ul class='action'>
                                        <li><a href='#' id='editModal' data-id='$row->city_id,$row->pincode_id' data-target='#edit-pincode' data-toggle='modal'><i class='fas fa-pencil-alt'></i></a></li>
                                        <li><a href=''><i class='fas fa-times'></i></a></li>
                                        <li><a href='delete/".$row->id."'><i class='fas fa-trash'></i></a></li>
                                    </ul>";
                            return $actionBtn;
                    })
                    ->editColumn('status', function($row) {
                        return ''.$row->status ? '<span class="badge badge-success">Success</span>' : '<span class="badge badge-secondary">Pending</span>'.'';
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
        }

        return view('admin.pincode.edit');
    }

    //-------------------- View Pincodes through Pincode link in Modal Page ---------------------------//
    public function viewForm($id)
    {
        $city = City::where('cities.id', $id)
                    ->select('states.name as state_name', 'states.id as state_id','cities.name as city_name', 'cities.id as city_id','manage_pin_codes.id as pincode_id','manage_pin_codes.pincode as pincode')
                    ->leftJoin('states', 'cities.state_id', '=', 'states.id')
                    ->leftJoin('manage_pin_codes', 'manage_pin_codes.city_id', '=', 'cities.id')
                    ->get();
                    //return $city;
        return response()->json($city);
    }

    //-------------------- Pincodes Edit Form ---------------------------//

    public function editForm(Request $request, $id)
    {
        $city = City::where('cities.id', $id)
                    ->select('states.name as state_name', 'states.id as state_id','cities.name as city_name', 'cities.id as city_id','manage_pin_codes.id as pincode_id','manage_pin_codes.pincode as pincode')
                    ->leftJoin('states', 'cities.state_id', '=', 'states.id')
                    ->leftJoin('manage_pin_codes', 'manage_pin_codes.city_id', '=', 'cities.id')
                    ->first();
        if(!empty($request->pincode_id)){
            $pincodes = ManagePinCode::where('manage_pin_codes.id', $request->pincode_id)->first();
                $city->pincode = implode(',', (array) $pincodes->pincode);
                $city->pincode_id = $pincodes->id;
        }


        // $city = ManagePinCode::where('manage_pin_codes.id', $request->pincode_id)
        // ->select('states.name as state_name', 'states.id as state_id','cities.name as city_name', 'cities.id as city_id','manage_pin_codes.id as pincode_id','manage_pin_codes.pincode as pincode')
        // ->leftJoin('states', 'manage_pin_codes.state_id', '=', 'states.id')
        // ->leftJoin('cities', 'manage_pin_codes.city_id', '=', 'cities.id')
        // ->first();

        return response()->json($city);
    }

    //-------------------- Add Pincodes in Edit Page ---------------------------//

    public function addForm($id)
    {
        $city = City::where('cities.state_id',$id)
                    ->select('cities.name as city_name','cities.id as city_id','states.name as state_name','states.id as state_id')
                    ->leftJoin('states', 'cities.state_id', '=', 'states.id')
                    ->get();
        return response()->json($city);
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
        $pinCode = ManagePinCode::find($id);
        $pinCode->state_id = $request->state_id;
        $pinCode->city_id = $request->city_id;
        $pinCode->pincode = implode(',', (array) $request->pincode);
        $pinCode->status = 1;
        $pinCode->save();
        return response()->json(['success'=>'Pincode updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinCode = ManagePinCode::find($id);
        $pinCode->delete();
        return redirect()->back()->with('message', 'Pincode deleted successfully.');
    }
}
