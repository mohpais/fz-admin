<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use DataTables;
use Validator;
use Session;
use PDF;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Getting data user
        if ($request->ajax()) {
            $users = User::latest()->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('photo', function($row) {
                    $url= asset('panel/images/');

                    if (!isset($row->profile_photo_path)) {
                        $photo = '<img src="'.$url.'/faces/default.png" class="avatar avatar-sm me-3" width="30">';
                    } else {
                        $photo = '<img src="'.$url.'/faces/face1.jpg" class="avatar avatar-sm me-3" width="30">';
                    }

                    return $photo;
                })
                ->addColumn('c_at', function ($row) {
                    return $row->created_at->format('d/m/y');
                  })
                ->addColumn('action', function($row) {
                    $btnAct = '<a href="javascript:void(0)" data-toggle="modal" data-id="'.$row->id.'" class="btn btn-outline-success btn-sm mr-1 editUser">Edit</a><a href="javascript:void(0)" data-id="'.$row->id.'" class="deleteUser btn btn-outline-danger btn-sm">Delete</a>';

                    return $btnAct;
                })
                ->rawColumns(['photo', 'c_at', 'action'])
                ->make(true);
        }

        return view('pages.user.index');
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
     * Show the form for profile a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = User::find(auth()->user()->id);
        $skills = Skill::latest()->get();

        return view('pages.profile.index', compact('user', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // Will return only validated data
        $validated = $request->validated();

        if(!$validated)
            return response()->json($validated, 500);

        $userId = $request->user_id;
        $exp   = User::updateOrCreate(
                    ['id' => $userId],
                    [
                        'fullname' => $request->fullname, 
                        'email' => $request->email, 
                        'username' => $request->username,
                        'phone' => $request->phone, 
                        'password' => Hash::make('random123')
                    ]
                );

        $reponse = (object)[
            'success' => true,
            'message' => $userId ? 'Successfully update user!' : 'Successfully store user!',
            'data' => json_encode(array($exp))
        ];

        return response()->json($reponse, 200);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generatePDF()
    {
        // $ID = $request->userId;
        // retreive data user using $id records from db
        // $data = User::findOrFail($ID);
        $data = User::all();

        // share data to view
        view()->share('user', $data);
        $pdf = PDF::loadView('template.download_cv_pdf', ['user' => $data]);

        // download PDF file with download method
        return $pdf->download('cv_mohpais.pdf');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get user by id
        $user = User::findOrFail($id);

        return response()->json($user, 200);
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
        $rules = [
            'email' => 'required',
            'fullname' => 'required'
        ];

        $messages = [
            'emai.required' => 'Masukkan email anda!',
            'fullname.required' => 'Masukkan nama anda!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = User::findOrFail($id);

        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->pod = $request->pod;
        $user->bod = $request->bod;
        $user->status = $request->status;
        $user->marital = $request->marital;

        $user->update();

        Session::flash('success', 'Successfully updating profile!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete user by ID
        $user = User::findOrFail($id)->delete();

        $reponse = (object)[
            "success" => true,
            "message" => 'Deleted users successfully!'
        ];

        return response()->json($reponse, 200);
    }
}
