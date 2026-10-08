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

    public function process(Request $request, $nim = null)
    {
        $nim = $nim ?? $request->nim;

        $data = DataSertifSeminar::select('nama', 'prodi')
            ->where('nim', $nim)
            ->first();

        if (!$data) {
            return redirect('/sertifikatseminar')
                ->with('error', 'Anda Tidak Terdaftar');
        }

        $filename = 'sertifikatseminar_' . $nim . '.pdf';
        $outputfile = storage_path('app/public/' . $filename);
        
        $this->fillPDF(
            $templatePath = public_path('template_sertif/sertifikatseminar.pdf'),
            $outputfile,
            $data->nama,
            $nim,
            $data->prodi
        );

        $token = sha1($nim . now());
        session()->put('pdf_' . $token, $filename);

        return redirect()->route('cetakseminar.download', $token);
    }

    public function download($token)
    {
        $filename = session()->get('pdf_' . $token);
        if (!$filename) abort(404);

        $path = storage_path('app/public/' . $filename);
        if (!file_exists($path)) abort(404);

        return response()->download($path)->deleteFileAfterSend(true);
    }

    public function fillPDF($file, $outputfile, $nama, $nim, $prodi)
    {
        $pdf = new FPDI();

        $pdf->setSourceFile($file);
        $template = $pdf->importPage(1);
        $size = $pdf->getTemplateSize($template);

        $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
        $pdf->useTemplate($template);

        $configPath = storage_path('app/seminar_cert_config.json');
        $config = [
            'y_nama' => 78,
            'y_nim' => 92,
            'y_prodi' => 100,
            'font_size_nama' => 25,
            'font_size_nim_prodi' => 18
        ];
        if (file_exists($configPath)) {
            $config = array_merge($config, json_decode(file_get_contents($configPath), true));
        }

        $pdf->SetFont('Helvetica', '', $config['font_size_nama']);
        $pdf->SetTextColor(0, 0, 0);

        $name = strtoupper($nama);

        $pageWidth = $pdf->GetPageWidth();
        $textWidthName = $pdf->GetStringWidth($name);
        $centerXName = ($pageWidth - $textWidthName) / 2;

        $pdf->SetXY($centerXName, $config['y_nama']);
        $pdf->Write(0, $name);

        $pdf->SetFont('Helvetica', '', $config['font_size_nim_prodi']);

        $textWidthNIM = $pdf->GetStringWidth("NIM : $nim");
        $centerXNIM = ($pageWidth - $textWidthNIM) / 2;

        $pdf->SetXY($centerXNIM, $config['y_nim']);
        $pdf->Write(0, "NIM : $nim");

        $textWidthProdi = $pdf->GetStringWidth("Program Studi : $prodi");
        $centerXProdi = ($pageWidth - $textWidthProdi) / 2;

        $pdf->SetXY($centerXProdi, $config['y_prodi']);
        $pdf->Write(0, "Program Studi : $prodi");

        $pdf->Output('F', $outputfile);
    }
}
