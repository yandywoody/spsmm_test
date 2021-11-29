<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller {

    public function index() {
        $dts = Location::all()->toArray();
        return array_reverse($dts);
    }

    public function store(Request $request) {
        $dt = new Location([
            'name' => $request->input('name'), 
            'max_qty' => $request->input('max_qty'),
            'area' => $request->input('area'), 
            'zone' => $request->input('zone'),
            'aisle' => $request->input('aisle'), 
            'bay' => $request->input('bay'), 
            'level' => $request->input('level'), 
            'position' => $request->input('position'), 
            'id_group' => $request->input('id_group')
        ]);
        $dt->save();
        return response()->json('Location created!');
    }

    public function show($id) {
        $dt = Location::find($id);
        return response()->json($dt);
    }

    public function update($id, Request $request) {
        $dt = Location::find($id);
        $dt->update($request->all());
        return response()->json('Location updated!');
    }

    public function destroy($id) {
        $dt = Location::find($id);
        $dt->delete();
        return response()->json('Location deleted!');
    }

}