<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Division;
use App\Models\Backend\District;
class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $divisions = Division::orderBy('priority', 'asc')->get();
       return view('backend.pages.division.manage', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.division.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          // validation form name
          $request->validate([
            'name'=>'required|max:255',
        ],
        [
            'name.required'=>'Please Insert the Brand name',
        ]
    );
        $division = new Division();
        $division->name = $request->name;
        $division->priority=  $request->priority;

        $division->save();

        return redirect()->route('division.manage');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $division = Division::find($id);
        if(!is_null($division)){
            return view('backend.pages.division.edit', compact('division'));
        }
        else{
            return redirect()->route('diivison.manage');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // validation form name
         $request->validate([
            'name'=>'required|max:255',
        ],
        [
            'name.required'=>'Please Insert the Brand name',
        ]
    );
        $division = Division::find($id);
        $division->name = $request->name;
        $division->priority=  $request->priority;

        $division->save();

        return redirect()->route('division.manage');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $division = Division::find($id);
        if(!is_null($division)){
            $districts = District::where('division_id', $division->id)->get();
            foreach($districts as $district){
                $district->delete();
            }
            $division->delete();
            return redirect()->route('division.manage');
        }
    }
}
