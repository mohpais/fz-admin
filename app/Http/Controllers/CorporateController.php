<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use App\Models\Corporate;
use App\Models\User;
use Carbon\Carbon;
use DataTables;

class CorporateController extends Controller
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
            $corporate = Corporate::latest()->get();
            return DataTables::of($corporate)
                ->addIndexColumn()
                ->addColumn('join_at', function ($row) {
                    return date('d/m/y', strtotime($row->join_at));
                })
                ->addColumn('resign_at', function ($row) {
                    if ($row->resign_at != null) {
                        return date('d/m/y', strtotime($row->resign_at));
                    } else {
                        return '<label class="badge badge-gradient-success">Current Work</label>';
                    }
                })
                ->addColumn('jobdesc', function ($row) {
                    if ($row->jobdesc) {
                        return new HtmlString($row->jobdesc);
                    } else {
                        return '';
                    }
                })
                ->addColumn('action', function($row) {
                    $btnAct = '<a href="javascript:void(0)" data-toggle="modal" data-id="'.$row->id.'" class="btn btn-outline-success btn-sm mr-1 editCorporate">Edit</a><a href="javascript:void(0)" data-id="'.$row->id.'" class="deleteCorporate btn btn-outline-danger btn-sm">Delete</a>';

                    return $btnAct;
                })
                ->rawColumns(['join_at', 'resign_at', 'jobdesc', 'action'])
                ->make(true);
        }
        // {!! stripslashes($chapter->description) !!}

        return view('pages.corporate.index');
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
        // Will return only validated data
        // $validated = $request->validated();

        // if(!$validated)
        //     return response()->json($validated, 500);

        $corporateID = $request->corporate_id;
        $exp = Corporate::updateOrCreate(
                    ['id' => $corporateID],
                    [
                        'name' => $request->name, 
                        'position' => $request->position,
                        'join_at' => $request->join_at,
                        'resign_at' => $request->resign_at,
                        'current' => $request->current,
                        'jobdesc' => $request->jobdesc
                    ]
                );
        
        if (!$corporateID && $exp->current == 1) {
            $user = User::find(auth()->user()->id);
            $user->corporate_id = $exp->id;
            $user->update();
        }

        $response = (object)[
            'success' => true,
            'message' => $corporateID ? 'Successfully update corporate!' : 'Successfully store corporate!',
            'data' => json_encode(array($exp))
        ];

        return response()->json($response, 200);
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
        // Get user by id
        $user = Corporate::findOrFail($id);

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
        //
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
        $user = Corporate::findOrFail($id)->delete();

        $reponse = (object)[
            "success" => true,
            "message" => 'Deleted corporate successfully!'
        ];

        return response()->json($reponse, 200);
    }

    public function corporateResourceAjax(Request $request)
    {
        // $data = [];
        $data = Corporate::latest()->get();

        if($request->has('q')){
            $search = $request->q;

            $data = Corporate::select("id", "name")
                ->where('name','LIKE',"%$search%")
                ->get();
        }

        return response()->json($data);
    }
}
