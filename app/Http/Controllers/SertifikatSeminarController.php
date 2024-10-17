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
        $masa = DB::SELECT('select masa from datasertif_seminar');
        return view('sertifikat.indexseminar')->with(compact('usersCount', 'usersData', 'masa'));
    }

    public function process(Request $request)
    {
        $nim = $request->post('nim');
        $pdf = DataSertifSeminar::select('nama', 'prodi')->where('nim', $nim)->first(); // Ambil juga kolom prodi

        if ($pdf == NULL) {
            alert()->error('ErrorAlert', 'Anda Tidak Terdaftar Kegiatan Seminar Akademik');
            return redirect('/sertifikatseminar');
        } else {
            $outputfile = storage_path() . '/sertifikatseminar.pdf';
            $this->fillPDF(storage_path() . '/template_sertif/sertifikatseminar.pdf', $outputfile, $pdf->nama, $nim, $pdf->prodi); // Tambahkan $pdf->prodi

            return response()->file($outputfile);
        }
    }

    public function fillPDF($file, $outputfile, $nama, $nim, $prodi)
    {
        // initiate FPDI
        $pdf = new FPDI();

        // Set the source file
        $pdf->setSourceFile($file);
        // Import page 1
        $template = $pdf->importPage(1);
        $size = $pdf->getTemplateSize($template);
        $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
        // Use the imported page
        $pdf->useTemplate($template);

        // Set font and color
        $pdf->SetFont('Helvetica', '', 25);
        $pdf->SetTextColor(0, 0, 0);

        // Convert the name to uppercase
        $name = strtoupper($nama);

        // Calculate the width of the page and the text
        $pageWidth = $pdf->GetPageWidth();
        $textWidthName = $pdf->GetStringWidth($name);

        // Calculate the X position for centering the text
        $centerXName = ($pageWidth - $textWidthName) / 2;

        // Set the X and Y position for the text
        $pdf->SetXY($centerXName, 78);
        $pdf->Write(0, $name);

        // Set font and size for the NIM
        $pdf->SetFont('Helvetica', '', 18);

        // Calculate the width of the text "NIM : $nim"
        $textWidthNIM = $pdf->GetStringWidth("NIM : $nim");

        // Calculate the X position for centering the text
        $centerXNIM = ($pageWidth - $textWidthNIM) / 2;

        // Set the X and Y position for the NIM text
        $pdf->SetXY($centerXNIM, 92);
        $pdf->Write(0, "NIM : $nim");

        // Set font and size for the Program Studi
        $pdf->SetFont('Helvetica', '', 18);

        // Calculate the width of the text "Program Studi : $prodi"
        $textWidthProdi = $pdf->GetStringWidth("Program Studi : $prodi");

        // Calculate the X position for centering the text
        $centerXProdi = ($pageWidth - $textWidthProdi) / 2;

        // Set the X and Y position for the Program Studi text
        $pdf->SetXY($centerXProdi, 100); // Sesuaikan posisi Y sesuai kebutuhan
        $pdf->Write(0, "Program Studi : $prodi");

        // Output the PDF
        return $pdf->Output($outputfile, 'F');
    }
}
