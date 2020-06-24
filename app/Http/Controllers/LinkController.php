<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        $links = $request->user()->links()->get();
        return response()->json([
            'status' => 'success', 
            'result' => $links
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $this->validate($request, [
            'route' => 'required',
            'url' => 'required',
            'description' => 'required'
        ]);

        if($request->user()->links()->create($request->all()))
            return response()->json(['status' => 'success']);
        else
            return response()->json(['status' => 'fail']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Link $link){
        // $link = Link::where('id', $id)->get();
        return response()->json($link);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $link = Link::find($id);
        $this->validate($request, [
            'route' => 'filled',
            'url' => 'filled',
            'description' => 'filled'
        ]);
        if($link->fill($request->all())->save())
            return response()->json(['status' => 'success']);
        else
            return response()->json(['status' => 'fail']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $link = Link::find($id);
        if($link->delete())
            return response()->json(['status' => 'success']);
        else
            return response()->json(['status' => 'fail']);
    }
}
