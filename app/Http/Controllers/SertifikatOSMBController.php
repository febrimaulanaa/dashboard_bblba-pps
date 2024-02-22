<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use App\Models\DataSertifOSMB;
use Illuminate\Support\Facades\DB;

class SertifikatOSMBController extends Controller
{
    public function index()
    {
        $usersCount = DataSertifOSMB::count();
        $usersData = DataSertifOSMB::all();
        $masa = DB::SELECT('select masa from datasertif_osmb');
        return view('sertifikat.indexosmb')->with(compact('usersCount', 'usersData', 'masa'));
    }

    public function process(Request $request)
    {
        $nim = $request->post('nim');
        $pdf = DataSertifOSMB::select('nama')->where('nim', $nim)->first();

        if ($pdf == NULL) {
            alert()->error('ErrorAlert', 'Anda Tidak Terdaftar OSMB');
            return redirect('/sertifikatosmb');
        } else {
            $outputfile = storage_path() . 'sertifikatosmb.pdf';
            $this->fillPDF(storage_path() . '/template_sertif/sertifikatosmb.pdf', $outputfile, $pdf->nama, $nim);

            return response()->file($outputfile);
        }
    }

    public function fillPDF($file, $outputfile, $nama, $nim)
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
        $pdf->SetFont('Helvetica', "", 25);
        $pdf->SetTextColor(0, 0, 0);
        $panjangnama = $pdf->GetStringWidth($name) - 5;
        $pdf->SetXY(143 - ($panjangnama / 2), 90);
        $pdf->Write(0, $name);

        $pdf->SetFont('Helvetica', "", 20);
        $pdf->SetTextColor(0, 0, 0);
        $noindukmhs = $pdf->GetStringWidth($nim) - 5;
        $pdf->SetXY(134 - ($noindukmhs / 2), 103);
        $pdf->Write(0, "NIM : $nim");

        return $pdf->Output($outputfile, 'F');
    }
}
