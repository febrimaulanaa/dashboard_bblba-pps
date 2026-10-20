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
        $certTemplate = \App\Models\CertificateTemplate::where('name', 'like', '%Seminar%')->first();
        $bgPath = null;
        if ($certTemplate && $certTemplate->background && \Storage::disk('public')->exists($certTemplate->background)) {
            $bgPath = storage_path('app/public/' . $certTemplate->background);
        }

        if ($bgPath && file_exists($bgPath)) {
            list($imgWidth, $imgHeight) = getimagesize($bgPath);
            $orientation = ($imgWidth >= $imgHeight) ? 'L' : 'P';
            $pageWidth = ($orientation === 'L') ? 297 : 210;
            $pageHeight = ($orientation === 'L') ? 210 : 297;

            $pdf = new FPDI($orientation, 'mm', [$pageWidth, $pageHeight]);
            $pdf->AddPage($orientation, [$pageWidth, $pageHeight]);
            $pdf->Image($bgPath, 0, 0, $pageWidth, $pageHeight);
        } else {
            $pdf = new FPDI();
            $pdf->setSourceFile($file);
            $template = $pdf->importPage(1);
            $size = $pdf->getTemplateSize($template);

            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($template);
        }

        $configPath = storage_path('app/seminar_cert_config.json');
        $config = [
            'y_nama' => 78,
            'y_nim' => 92,
            'y_prodi' => 100,
            'font_size_nama' => 25,
            'font_size_nim_prodi' => 18
        ];
        if ($certTemplate && !empty($certTemplate->settings_json)) {
            $s = is_array($certTemplate->settings_json) ? $certTemplate->settings_json : (json_decode($certTemplate->settings_json, true) ?: []);
            $config['y_nama'] = (float)($s['name_y'] ?? $s['y_nama'] ?? $config['y_nama']);
            $config['font_size_nama'] = (int)($s['name_font_size'] ?? $s['font_size_nama'] ?? $config['font_size_nama']);
            $config['y_nim'] = (float)($s['y_nim'] ?? $config['y_nim']);
            $config['y_prodi'] = (float)($s['y_prodi'] ?? $config['y_prodi']);
            $config['font_size_nim_prodi'] = (int)($s['font_size_nim_prodi'] ?? $config['font_size_nim_prodi']);
        } elseif (file_exists($configPath)) {
            $config = array_merge($config, json_decode(file_get_contents($configPath), true) ?: []);
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
