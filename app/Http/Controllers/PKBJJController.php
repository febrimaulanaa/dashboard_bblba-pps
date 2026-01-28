<?php

namespace App\Http\Controllers;

use App\Models\JadwalPKBJJ;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class PKBJJController extends Controller
{
    public function index()
    {
        $jdpkbjj = JadwalPKBJJ::get();
        return view('pkbjj.index')->with(compact('jdpkbjj'));
    }

    public function cekjadwalpkbjj(Request $request)
    {
        $data = $request->validate(['nim' => 'required']);
        $jadwal = JadwalPKBJJ::select(['nim', 'nama', 'tanggal', 'skema', 'link_lok'])->where('nim', $data['nim'])->first();
        if (is_null($jadwal)) {
            return response()->json($this->response(false), 404);
        }
        return response()->json($this->response(true, $jadwal->toArray()));
    }

    private function response($status, $data = array())
    {
        return [
            'status' => $status,
            'data' => $data
        ];
    }
}
