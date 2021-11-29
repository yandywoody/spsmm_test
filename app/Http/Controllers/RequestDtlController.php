<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\RequestDtl;
use App\Models\Product;

class RequestDtlController extends Controller {

    public function index() {
        $dts = RequestDtl::all()->toArray();
        return array_reverse($dts);
    }

    public function store(Request $request) {
        $dt = new RequestDtl([
            'request_hdr_id' => $request->input('request_hdr_id'), 
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'comments' => $request->input('comments')
        ]);
        $dt->save();

        $update_prd = Product::find($request->input('product_id'));
        $update_prd->stock = $update_prd->stock - $request->input('quantity');
        $update_prd->save();

        return response()->json('Request Detail created!');
    }

    public function show($id) {
        $dt = RequestDtl::with('product.location')->where('request_hdr_id', $id)->get()->toArray();
        return response()->json($dt);
    }

    public function update($id, Request $request) {
        $dt = RequestDtl::find($id);
        $dt->update($request->all());
        return response()->json('Request Detail updated!');
    }

    public function destroy($id) {
        $dt = RequestDtl::find($id);
        $dt->delete();
        return response()->json('Request Detail deleted!');
    }

}