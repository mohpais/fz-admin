<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
                ->addColumn('action', function($row) {
                    $btnAct = '<a href="javascript:void(0)" data-toggle="modal" data-id="'.$row->id.'" class="btn btn-outline-success btn-sm mr-1 editExp">Edit</a><a href="javascript:void(0)" data-id="'.$row->id.'" class="deleteExp btn btn-outline-danger btn-sm">Delete</a>';

                    return $btnAct;
                })
                ->addColumn('c_at', function($row) {
                    $btnAct = '<a href="javascript:void(0)" data-toggle="modal" data-id="'.$row->id.'" class="btn btn-outline-success btn-sm mr-1 editExp">Edit</a><a href="javascript:void(0)" data-id="'.$row->id.'" class="deleteExp btn btn-outline-danger btn-sm">Delete</a>';

                    return $btnAct;
                })
                ->rawColumns(['photo', 'action'])
                ->make(true);
        }

        return view('pages.dashboard.index');
    }

    public function skillView(Request $request)
    {
        // Getting data user
        if ($request->ajax()) {
            $skills = Skill::latest()->get();
            return DataTables::of($skills)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btnAct = '<a href="javascript:void(0)" data-toggle="modal" data-id="'.$row->id.' mr-2" class="btn btn-outline-success btn-sm mr-1 editExp">Edit</a><a href="javascript:void(0)" data-id="'.$row->id.'" class="deleteExp btn btn-outline-danger btn-sm">Delete</a>';

                    return $btnAct;
                })
                ->addColumn('icon', function($row) {
                    if ($row->icon) {
                        return '<label class="badge badge-gradient-info"><i class="'.$row->icon.' mr-2"></i>'.$row->icon.'</label>';
                    }
                    
                    return '<label class="badge badge-gradient-danger">Tidak ada</label>';
                })
                ->addColumn('c_at', function($row) {
                    // return date('d/m/y', strtotime($row->created_at));
                    return $row->created_at->format('d/m/y');
                })
                ->rawColumns(['action', 'icon', 'c_at'])
                ->make(true);
        }

        return view('pages.skill.index');
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function skillStore(Request $request)
    {
        // Will return only validated data
        // $validated = $request->validated();

        // if(!$validated)
        //     return response()->json($validated, 500);

        $skillId = $request->skill_id;
        $skill   = Skill::updateOrCreate(
                    ['id' => $skillId],
                    [
                        'name' => $request->name, 
                        'icon' => $request->icon
                    ]
                );

        $reponse = (object)[
            'success' => true,
            'message' => $skillId ? 'Successfully update skill!' : 'Successfully store skill!',
            'data' => json_encode(array($skill))
        ];

        return response()->json($reponse, 200);
    }

    public function skillResourceAjax(Request $request)
    {
        // $data = [];
        $data = Skill::latest()->get();

        if($request->has('q')){
            $search = $request->q;

            $data = Skill::select("id","name")
                ->where('name','LIKE',"%$search%")
                ->get();
        }

        return response()->json($data);
    }
}
