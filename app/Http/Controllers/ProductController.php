<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller {

    public function index() {
        $dts = Product::with('location')->get()->toArray();
        return array_reverse($dts);
    }

    public function store(Request $request) {
        $dt = new Product([
            'name' => $request->input('name'), 
            'detail' => $request->input('detail'),
            'location_id' => $request->input('location_id'), 
            'stock' => $request->input('stock'),
            'satuan' => $request->input('satuan')
        ]);
        $dt->save();
        return response()->json('Product created!');
    }

    public function show($id) {
        $dt = Product::find($id);
        return response()->json($dt);
    }

    public function update($id, Request $request) {
        $dt = Product::find($id);
        $dt->update($request->all());
        return response()->json('Product updated!');
    }

    public function destroy($id) {
        $dt = Product::find($id);
        $dt->delete();
        return response()->json('Product deleted!');
    }

}