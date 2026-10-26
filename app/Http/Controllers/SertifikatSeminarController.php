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
        try {
            $nim = $nim ?? $request->nim;

            $data = DataSertifSeminar::select('nama', 'prodi')
                ->where('nim', $nim)
                ->first();

            if (!$data) {
                return redirect('/sertifikatseminar')
                    ->with('error', 'Anda Tidak Terdaftar');
            }

            $templatePath = \App\Http\Controllers\AdminController::getSeminarTemplatePath();
            if (!$templatePath || !@file_exists($templatePath)) {
                return redirect('/sertifikatseminar')
                    ->with('error', 'Template sertifikat seminar belum tersedia. Silakan hubungi admin.');
            }

            $storageDir = storage_path('app/public');
            if (!@file_exists($storageDir)) {
                @mkdir($storageDir, 0777, true);
            }

            $filename = 'sertifikatseminar_' . $nim . '.pdf';
            $outputfile = $storageDir . '/' . $filename;
            
            $this->fillPDF(
                $templatePath,
                $outputfile,
                $data->nama,
                $nim,
                $data->prodi
            );

            $token = sha1($nim . now());
            session()->put('pdf_' . $token, $filename);

            return redirect()->route('cetakseminar.download', $token);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Error in SertifikatSeminar process: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return redirect('/sertifikatseminar')
                ->with('error', 'Gagal memproses sertifikat: ' . $e->getMessage());
        }
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
        if (!@file_exists($file)) {
            throw new \Exception('File template sertifikat seminar tidak ditemukan.');
        }

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
        if (@file_exists($configPath) && @is_readable($configPath)) {
            $raw = @file_get_contents($configPath);
            if ($raw) {
                $decoded = json_decode($raw, true);
                if (is_array($decoded)) {
                    $config = array_merge($config, $decoded);
                }
            }
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
