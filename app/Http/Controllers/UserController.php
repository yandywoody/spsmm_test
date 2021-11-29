<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {

    public function index() {
        $dts = User::all()->toArray();
        return array_reverse($dts);
    }

    public function store(Request $request) {
        $dt = new User([
            'name' => $request->input('name'), 
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), 
            'nik' => $request->input('nik'),
            'departement' => $request->input('departement')
        ]);
        $dt->save();
        return response()->json('User created!');
    }

    public function show($id) {
        $dt = User::find($id);
        return response()->json($dt);
    }

    public function update($id, Request $request) {
        $dt = User::find($id);
        $dt->update($request->all());
        return response()->json('User updated!');
    }

    public function destroy($id) {
        $dt = User::find($id);
        $dt->delete();
        return response()->json('User deleted!');
    }

}