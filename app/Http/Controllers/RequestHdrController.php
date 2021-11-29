<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\RequestHdr;
use Carbon\Carbon;

class RequestHdrController extends Controller {

    public function index() {
        $dts = RequestHdr::with('user')->get()->toArray();
        return array_reverse($dts);
    }

    public function store(Request $request) {
        $dt = new RequestHdr([
            'doc_num' => $request->input('doc_num'), 
            'doc_date' => Carbon::parse($request->input('doc_date'))->toDateTimeString(),
            'user_id' => $request->input('user_id'),
            'approve' => $request->input('approve'),
            'comments' => $request->input('comments')
        ]);
        $dt->save();
        return response()->json($dt);
    }

    public function show($id) {
        $dt = RequestHdr::with('user')->where('id', $id)->get()->toArray();
        return response()->json($dt);
    }

    public function update($id, Request $request) {
        $dt = RequestHdr::find($id);
        $dt->update($request->all());
        return response()->json('Request Header updated!');
    }

    public function destroy($id) {
        $dt = RequestHdr::find($id);
        $dt->delete();
        return response()->json('Request Header deleted!');
    }

}