<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Proyek;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Mahasiswa
        $mahasiswa1 = Mahasiswa::create([
            'nama' => 'Budi Santoso',
            'nim' => '2021001',
            'email' => 'budi.santoso@example.com',
            'foto' => null,
        ]);

        $mahasiswa2 = Mahasiswa::create([
            'nama' => 'Siti Nurhaliza',
            'nim' => '2021002',
            'email' => 'siti.nurhaliza@example.com',
            'foto' => null,
        ]);

        // Create Dosen
        $dosen1 = Dosen::create([
            'nama' => 'Dr. Ahmad Wijaya',
            'nip' => '199001012020',
            'email' => 'ahmad.wijaya@example.com',
            'bidang_keahlian' => 'Artificial Intelligence',
        ]);

        $dosen2 = Dosen::create([
            'nama' => 'Prof. Sri Mulyani',
            'nip' => '198505052019',
            'email' => 'sri.mulyani@example.com',
            'bidang_keahlian' => 'Data Science',
        ]);

        // Create Proyek
        Proyek::create([
            'judul' => 'Sistem Informasi Perpustakaan',
            'deskripsi' => 'Pengembangan sistem informasi untuk manajemen perpustakaan digital dengan fitur katalog buku, peminjaman online, dan notifikasi otomatis.',
            'mahasiswa_id' => $mahasiswa1->id,
            'dosen_id' => $dosen1->id,
            'dokumen' => null,
            'status' => 'active',
        ]);

        Proyek::create([
            'judul' => 'Aplikasi E-Learning Interaktif',
            'deskripsi' => 'Platform pembelajaran online dengan video pembelajaran, quiz interaktif, dan forum diskusi untuk meningkatkan pembelajaran jarak jauh.',
            'mahasiswa_id' => $mahasiswa2->id,
            'dosen_id' => $dosen2->id,
            'dokumen' => null,
            'status' => 'active',
        ]);
    }
}
