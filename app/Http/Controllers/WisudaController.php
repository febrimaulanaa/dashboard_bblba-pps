<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use App\Models\Wisuda;
use Illuminate\Support\Facades\DB;

class WisudaController extends Controller
{
    public function index()
    {
        $usersCount = Wisuda::count();
        $usersData = Wisuda::all();
        return view('sertifikat.indexwisuda')->with(compact('usersCount', 'usersData'));
    }

    public function process(Request $request)
    {
        $nim = $request->post('nim');
        $pdf = Wisuda::select('kelompok', 'prodi','no_meja_ambil_ijazah', 'no_urut_ijazah', 'nama')->where('nim', $nim)->first();

        if ($pdf == NULL) {
            alert()->error('Maaf', 'Anda Tidak Terdaftar Wisuda Daerah UT Jakarta');
            return redirect('/mejaijazah');
        } else {
            $outputfile = storage_path() . 'mejaijazah.pdf';
            $this->fillPDF(storage_path() . '/template_sertif/mejaijazah.pdf', $outputfile, $pdf->nama, $nim, $pdf->kelompok, $pdf->prodi, $pdf->no_meja_ambil_ijazah, $pdf->no_urut_ijazah);

            return response()->file($outputfile);
        }
    }


    public function fillPDF($file, $outputfile, $nama, $nim, $kelompok, $prodi, $no_meja_ambil_ijazah, $no_urut_ijazah)
    {


        // Cetak Cert
        // initiate FPDI
        $pdf = new FPDI();
       

        // set the source file
        $pdf->setSourceFile($file);
        // import page 1
        $template = $pdf->importPage(1);
        $size = $pdf->getTemplateSize($template);
        $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($template);
        $name = strtoupper($nama);
    
        // now write some text above the imported page

        $pdf->SetFont('Helvetica', 'B', 58);
        $pdf->SetTextColor(0, 0, 0);
        $nokel = $pdf->GetStringWidth($kelompok);
        $pdf->SetXY(49 - ($nokel / 2), 81);
        $pdf->Write(0, "KELOMPOK");
        $pdf->SetXY(102 - ($nokel / 2), 82);
        $pdf->Write(45, $kelompok);

        $pdf->SetFont('Helvetica', "", 23);
        $pdf->SetTextColor(0, 0, 0);
        $panjangnama = $pdf->GetStringWidth($name) - 5;
        $pdf->SetXY(100 - ($panjangnama / 2), 126);
        $pdf->Write(0, $name);

        $pdf->SetFont('Helvetica', "", 20);
        $pdf->SetTextColor(0, 0, 0);
        $noindukmhs = $pdf->GetStringWidth($nim) - 5;
        $pdf->SetXY(90 - ($noindukmhs / 2), 138);
        $pdf->Write(0, "NIM : $nim");

        $pdf->SetFont('Helvetica', "", 20);
        $pdf->SetTextColor(0, 0, 0);
        $programstudi = $pdf->GetStringWidth($prodi);
        $pdf->SetXY(90 - ($programstudi / 2), 150);
        $pdf->Write(0, $prodi);

        $pdf->SetFont('Helvetica', "B", 30);
        $pdf->SetTextColor(0, 0, 0);
        $nourut = $pdf->GetStringWidth($no_urut_ijazah);
        $pdf->SetXY(59 - ($nourut / 2), 176);
        $pdf->Write(0, "Nomor Urut Ijazah");
        $pdf->SetXY(102 - ($nourut / 2), 167);
        $pdf->Write(45, $no_urut_ijazah);

        $pdf->SetFont('Helvetica', "B", 30);
        $pdf->SetTextColor(0, 0, 0);
        $mejaijazah = $pdf->GetStringWidth($no_meja_ambil_ijazah);
        $pdf->SetXY(59 - ($mejaijazah / 2), 209);
        $pdf->Write(0, "Nomor Meja Ijazah");
        $pdf->SetXY(102 - ($mejaijazah / 2), 201);
        $pdf->Write(45, $no_meja_ambil_ijazah);


        return $pdf->Output($outputfile, 'F');
    }
}
