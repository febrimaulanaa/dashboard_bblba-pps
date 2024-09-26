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
        $pdf = Wisuda::select('kelompok', 'prodi', 'no_meja_ambil_ijazah', 'no_urut_ijazah', 'nama')->where('nim', $nim)->first();

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

        $pdf->SetFont('Helvetica', 'B', 30);
        $pdf->SetTextColor(0, 0, 0);

        // Ambil lebar halaman
        $lebarHalaman = $pdf->GetPageWidth(); // Atau gunakan $pdf->w untuk mendapatkan lebar halaman saat ini

        // Ambil lebar teks yang akan dicetak
        $lebarTeks = $pdf->GetStringWidth("Wisuda");

        // Hitung posisi X untuk menempatkan teks di tengah
        $posisiX = ($lebarHalaman - $lebarTeks) / 2;

        // Set posisi X dan Y, Y bisa diatur sesuai kebutuhan Anda
        $pdf->SetXY($posisiX, 51);

        // Cetak teks
        $pdf->Write(0, "Wisuda");

        // Ambil lebar teks yang akan dicetak
        $lebarTeks = $pdf->GetStringWidth("Universitas Terbuka Jakarta");

        // Hitung posisi X untuk menempatkan teks di tengah
        $posisiX = ($lebarHalaman - $lebarTeks) / 2;

        // Set posisi X dan Y, Y bisa diatur sesuai kebutuhan Anda
        $pdf->SetXY($posisiX, 69);

        // Cetak teks
        $pdf->Write(0, "Universitas Terbuka Jakarta");


        // Ulangi proses yang sama untuk teks lainnya jika perlu
        $lebarTeksKelompok = $pdf->GetStringWidth($kelompok);
        $posisiXKelompok = ($lebarHalaman - $lebarTeksKelompok) / 2;
        $pdf->SetXY($posisiXKelompok, 96);


        $pdf->SetFont('Helvetica', 'B', 45);
        $pdf->SetTextColor(0, 0, 0);

        // Ambil lebar halaman
        $lebarHalaman = $pdf->GetPageWidth(); // Atau bisa gunakan $pdf->w juga

        // Ambil lebar teks "Kelompok $kelompok"
        $lebarTeksKelompok = $pdf->GetStringWidth("Kelompok $kelompok");

        // Hitung posisi X untuk menempatkan teks di tengah
        $posisiXKelompok = ($lebarHalaman - $lebarTeksKelompok) / 2;

        // Set posisi X dan Y untuk teks, Y bisa Anda sesuaikan (misalnya 81)
        $pdf->SetXY($posisiXKelompok, 59);

        // Cetak teks "Kelompok $kelompok"
        $pdf->Write(83, "Kelompok $kelompok");


        $pdf->SetFont('Helvetica', "", 23);
        $pdf->SetTextColor(0, 0, 0);
        // Ambil lebar halaman
        $lebarHalaman = $pdf->GetPageWidth(); // Atau bisa gunakan $pdf->w juga

        // Ambil lebar teks "Kelompok $kelompok"
        $lebarTeksNama = $pdf->GetStringWidth("$name");

        // Hitung posisi X untuk menempatkan teks di tengah
        $posisiXNama = ($lebarHalaman - $lebarTeksNama) / 2;

        // Set posisi X dan Y untuk teks, Y bisa Anda sesuaikan (misalnya 81)
        $pdf->SetXY($posisiXNama, 125);

        // Cetak teks "Nama $Nama"
        $pdf->Write(83, $name);


        $pdf->SetFont('Helvetica', "", 20);
        $pdf->SetTextColor(0, 0, 0);
        $lebarHalaman = $pdf->GetPageWidth(); // Atau bisa gunakan $pdf->w juga

        // Ambil lebar teks "Kelompok $kelompok"
        $lebarTeksNIM = $pdf->GetStringWidth("$nim");

        // Hitung posisi X untuk menempatkan teks di tengah
        $posisiXNIM = ($lebarHalaman - $lebarTeksNIM) / 2;

        // Set posisi X dan Y untuk teks, Y bisa Anda sesuaikan (misalnya 81)
        $pdf->SetXY($posisiXNIM, 140);

        // Cetak teks "Nama $Nama"
        $pdf->Write(83, $nim);

        $pdf->SetFont('Helvetica', "", 20);
        $pdf->SetTextColor(0, 0, 0);
        $lebarHalaman = $pdf->GetPageWidth(); // Atau bisa gunakan $pdf->w juga

        // Ambil lebar teks "Kelompok $kelompok"
        $lebarTeksProdi = $pdf->GetStringWidth("$prodi");

        // Hitung posisi X untuk menempatkan teks di tengah
        $posisiXProdi = ($lebarHalaman - $lebarTeksProdi) / 2;

        // Set posisi X dan Y untuk teks, Y bisa Anda sesuaikan (misalnya 81)
        $pdf->SetXY($posisiXProdi, 155);

        // Cetak teks "Nama $Nama"
        $pdf->Write(83, $prodi);

        $pdf->SetFont('Helvetica', "B", 30);
        $pdf->SetTextColor(0, 0, 0);

        // Ambil lebar halaman
        $lebarHalaman = $pdf->GetPageWidth(); // Bisa gunakan $pdf->w juga

        // Ambil lebar teks "Nomor Urut Barisan"
        $lebarTeksBarisan = $pdf->GetStringWidth("Nomor Urut Barisan");

        // Hitung posisi X untuk menempatkan teks "Nomor Urut Barisan" di tengah
        $posisiXBarisan = ($lebarHalaman - $lebarTeksBarisan) / 2;

        // Set posisi X dan Y untuk teks "Nomor Urut Barisan"
        $pdf->SetXY($posisiXBarisan, 102); // Y bisa Anda sesuaikan
        $pdf->Write(45, "Nomor Urut Barisan");

        // Ambil lebar teks variabel $no_urut_ijazah
        $lebarTeksNomorBarisan = $pdf->GetStringWidth($no_urut_ijazah);

        // Hitung posisi X untuk teks $no_urut_ijazah agar berada di tengah
        $posisiXNomorBarisan = ($lebarHalaman - $lebarTeksNomorBarisan) / 2;

        // Set posisi X dan Y untuk teks $no_urut_ijazah, Y digeser lebih ke bawah (misalnya 140)
        $pdf->SetXY($posisiXNomorBarisan, 121); // Sesuaikan Y agar berada di bawah teks sebelumnya

        // Cetak teks variabel $no_urut_ijazah di bawah teks "Nomor Urut Barisan"
        $pdf->Write(45, $no_urut_ijazah);

        $pdf->SetFont('Helvetica', "B", 30);
        $pdf->SetTextColor(0, 0, 0);
        // Ambil lebar halaman
        $lebarHalaman = $pdf->GetPageWidth(); // Bisa gunakan $pdf->w juga

        // Ambil lebar teks "Nomor Urut Barisan"
        $lebarTeksMeja = $pdf->GetStringWidth("Nomor Meja Ijazah");

        // Hitung posisi X untuk menempatkan teks "Nomor Urut Barisan" di tengah
        $posisiXMeja = ($lebarHalaman - $lebarTeksMeja) / 2;

        // Set posisi X dan Y untuk teks "Nomor Urut Meja"
        $pdf->SetXY($posisiXMeja, 197); // Y bisa Anda sesuaikan
        $pdf->Write(45, "Nomor Meja Ijazah");

        // Ambil lebar teks variabel $no_urut_ijazah
        $lebarTeksNomorMeja = $pdf->GetStringWidth($no_urut_ijazah);

        // Hitung posisi X untuk teks $no_urut_ijazah agar berada di tengah
        $posisiXNomorMeja = ($lebarHalaman - $lebarTeksNomorMeja) / 2;

        // Set posisi X dan Y untuk teks $no_urut_ijazah, Y digeser lebih ke bawah (misalnya 140)
        $pdf->SetXY($posisiXNomorMeja, 212); // Sesuaikan Y agar berada di bawah teks sebelumnya

        // Cetak teks varNomor Meja Ijazah"
        $pdf->Write(45, $no_urut_ijazah);


        return $pdf->Output($outputfile, 'F');
    }
}
