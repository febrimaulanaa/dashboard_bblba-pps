<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use App\Models\DataSertifSeminar;
use Illuminate\Support\Facades\DB;

class SertifikatSeminarController extends Controller
{
    public function index()
    {
        $usersCount = DataSertifSeminar::count();
        $usersData = DataSertifSeminar::all();
        $masa = DataSertifSeminar::pluck('masa');
        return view('sertifikat.indexseminar')->with(compact('usersCount', 'usersData', 'masa'));
    }

    public function process(Request $request)
    {
        $nim = $request->nim;

        $data = DataSertifSeminar::select('nama', 'prodi')
            ->where('nim', $nim)
            ->first();

        if (!$data) {
            return redirect('/sertifikatseminar')
                ->with('error', 'Anda Tidak Terdaftar');
        }

        $templatePath = storage_path('template_sertif/sertifikatseminar.pdf');

        $pdf = $this->fillPDF(
            $templatePath,
            $data->nama,
            $nim,
            $data->prodi
        );

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="sertifikat_' . $nim . '.pdf"');
    }

    public function fillPDF($file, $nama, $nim, $prodi)
    {
        $pdf = new FPDI();

        $pdf->setSourceFile($file);
        $template = $pdf->importPage(1);
        $size = $pdf->getTemplateSize($template);

        $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
        $pdf->useTemplate($template);

        $pdf->SetFont('Helvetica', '', 25);
        $pdf->SetTextColor(0, 0, 0);

        $name = strtoupper($nama);

        $pageWidth = $pdf->GetPageWidth();
        $textWidthName = $pdf->GetStringWidth($name);
        $centerXName = ($pageWidth - $textWidthName) / 2;

        $pdf->SetXY($centerXName, 78);
        $pdf->Write(0, $name);

        $pdf->SetFont('Helvetica', '', 18);

        $textWidthNIM = $pdf->GetStringWidth("NIM : $nim");
        $centerXNIM = ($pageWidth - $textWidthNIM) / 2;

        $pdf->SetXY($centerXNIM, 92);
        $pdf->Write(0, "NIM : $nim");

        $textWidthProdi = $pdf->GetStringWidth("Program Studi : $prodi");
        $centerXProdi = ($pageWidth - $textWidthProdi) / 2;

        $pdf->SetXY($centerXProdi, 100);
        $pdf->Write(0, "Program Studi : $prodi");

        return $pdf->Output('', 'S');
    }
}
