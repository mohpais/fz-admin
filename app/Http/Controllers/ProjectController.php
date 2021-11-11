<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectSkill;
use App\Models\Corporate;
use Illuminate\Http\Request;
use Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $projects = Project::latest()->get();

        return view('pages.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $corporates = Corporate::all();

        return view('pages.project.create', compact('corporates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code = 200;
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,csv,txt,pdf|max:1048',
            'corporate_id' => 'required',
            'name' => 'required',
            'start_at' => 'required',
            'tags' => 'required'
        ]);

        if ($validator->fails()) {
            $response = (object)[
                "success" => false,
                "message" => $validator->errors()->first('file') // Error response
            ];
            $code = 500;
        } else {
            $file = $request->file('file');
            if ($file) {
                $filename = time().'_'.$file->getClientOriginalName();
                // File extension
                $extension = $file->getClientOriginalExtension();
                // File upload location
                $destinationPath = public_path('images/thumbnail');
                // Upload file
                $file->move($destinationPath, $filename);
                // File path
                $filepath = url('images/thumbnail/'.$filename);
                $file = $filepath;
            }
            $project = Project::create([
                "corporate_id" => $request->corporate_id,
                "slug" => Project::generateSlug($request->name),
                "name" => $request->name,
                "start_at" => $request->start_at,
                "end_at" => $request->end_at,
                "description" => $request->description,
                "active" => $request->current,
                "thumbnail" => $file
            ]);

            if (isset($project->id)) {
                # code...
                $status = true;
                foreach ($request->tags as $key => $value) {
                    # code...
                    $projectSkill = new ProjectSkill;
                    $projectSkill->project_id = $project->id;
                    $projectSkill->skill_id = $value;
                    $projectSkill->save();

                    if (!isset($projectSkill->id)) {
                        $status = false;
                        $code = 500;
                    }
                }
                // Response
                $response = (object)[
                    "success" => $status,
                    "message" => $status ? 'Created project Successfully!' : 'Created project Fail!',
                    "data" => $project
                ];
            } else {
                // Response
                $response = (object)[
                    "success" => false,
                    "message" => 'Created project Fail!'
                ];
            }
        }

        return response()->json($response, 200);
    }

    public function readSerialize($data = null)
    {
        if (!isset($data)) return '';
        $result = array();
        foreach ((explode('&', $data)) as $index => $value) {
            $vals = explode('=', $value);
            array_push($result, (object)[
                $vals[0] => $vals[1]
            ]);
        }
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
