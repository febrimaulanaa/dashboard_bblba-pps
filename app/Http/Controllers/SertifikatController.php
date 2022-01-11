<?php

namespace App\Http\Controllers;

use App\Models\DataSertifMhs;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{

    public function index()
    {
        $usersCount = DataSertifMhs::count();
        $usersData = DataSertifMhs::all();
        return view('sertifikat.index')->with(compact('usersCount', 'usersData'));
    }

    public function process(Request $request)
    {
        $nim = $request->post('nim');
        $pdf = DataSertifMhs::select('nama')->where('nim', $nim)->first();

        if ($pdf == NULL) {
            alert()->error('ErrorAlert', 'Anda Tidak Terdaftar PKBJJ');
            return redirect('/sertifikat');
        } else {
            $outputfile = public_path() . 'sertifikatpkbjj.pdf';
            $this->fillPDF(public_path() . '/master/sertifikatpkbjj.pdf', $outputfile, $pdf->nama);

            return response()->file($outputfile);
        }
    }

    public function fillPDF($file, $outputfile, $nama)
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

        $template2 = $pdf->importPage(2);
        $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($template2);
        $name = strtoupper($nama);
        // now write some text above the imported page

        return $pdf->Output($outputfile, 'F');
    }
}
