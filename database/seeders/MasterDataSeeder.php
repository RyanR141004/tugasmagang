<?php

namespace Database\Seeders;

use App\Models\Opd;
use App\Models\Option;
use App\Models\Period;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin User ──
        User::updateOrCreate(
            ['email' => 'admin@kematangan.test'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
            ]
        );

        // ── OPDs (26) ──
        $opds = [
            'Badan Kepegawaian dan Pengembangan SDM',
            'Badan Kesatuan Bangsa dan Politik',
            'Badan Keuangan dan Aset Daerah',
            'Badan Pendapatan Daerah',
            'Badan Perencanaan Pembangunan Daerah',
            'Badan Penanggulangan Bencana Daerah',
            'Badan Riset dan Inovasi Daerah',
            'Badan Pengelola Keuangan dan Aset Daerah',
            'Dinas Kepemudaan, Olahraga dan Pariwisata',
            'Dinas Komunikasi dan Informatika',
            'Dinas Koperasi, Perindustrian dan Perdagangan',
            'Dinas Lingkungan Hidup',
            'Dinas Pekerjaan Umum, Penataan Ruang, Perumahan dan Kawasan Permukiman',
            'Dinas Pendidikan dan Kebudayaan',
            'Dinas Perhubungan',
            'Dinas Pertanian dan Ketahanan Pangan',
            'Dinas Sosial, Pemberdayaan Perempuan, Perlindungan Anak, Pengendalian Penduduk dan KB',
            'Dinas Tenaga Kerja, Penanaman Modal dan Pelayanan Terpadu Satu Pintu',
            'Inspektorat',
            'Kecamatan Blimbing',
            'Kecamatan Kedungkandang',
            'Kecamatan Klojen',
            'Kecamatan Lowokwaru',
            'Kecamatan Sukun',
            'Sekretariat Daerah',
            'Sekretariat DPRD',
        ];

        foreach ($opds as $name) {
            Opd::updateOrCreate(['name' => $name]);
        }

        // ── Questions (11) ──
        $questions = [
            ['code' => 'Q1',  'order_no' => 1,  'question_text' => 'Bagaimana cara penentuan kegiatan yang diprioritaskan dalam perencanaan tahunan?'],
            ['code' => 'Q2',  'order_no' => 2,  'question_text' => 'Bagaimana metode pengendalian program kegiatan dilakukan di perangkat daerah?'],
            ['code' => 'Q3',  'order_no' => 3,  'question_text' => 'Bagaimana proses penjaminan mutu dilakukan di perangkat daerah?'],
            ['code' => 'Q4',  'order_no' => 4,  'question_text' => 'Sejauh mana pengelolaan SOP di perangkat daerah anda?'],
            ['code' => 'Q5',  'order_no' => 5,  'question_text' => 'Bagaimana rencana pengembangan kompetensi pegawai di perangkat daerah anda?'],
            ['code' => 'Q6',  'order_no' => 6,  'question_text' => 'Bagaimana proses analisis kebijakan di perangkat daerah Anda?'],
            ['code' => 'Q7',  'order_no' => 7,  'question_text' => 'Bagaimana pengelolaan sumber daya dalam pelaksanaan proyek di perangkat daerah anda?'],
            ['code' => 'Q8',  'order_no' => 8,  'question_text' => 'Bagaimana pengelolaan risiko dalam tugas perangkat daerah Anda?'],
            ['code' => 'Q9',  'order_no' => 9,  'question_text' => 'Bagaimana pengukuran kinerja di perangkat daerah Anda?'],
            ['code' => 'Q10', 'order_no' => 10, 'question_text' => 'Bagaimana perangkat daerah Anda mengembangkan inovasi?'],
            ['code' => 'Q11', 'order_no' => 11, 'question_text' => 'Bagaimana penerapan budaya organisasi di perangkat daerah Anda?'],
        ];

        foreach ($questions as $q) {
            Question::updateOrCreate(['code' => $q['code']], $q);
        }

        // ── Options ──
        $options = [
            // Q1
            ['q' => 'Q1', 'label' => 'A', 'points' => 1, 'text' => 'Tanpa kriteria yang terukur'],
            ['q' => 'Q1', 'label' => 'B', 'points' => 2, 'text' => 'Berdasarkan perbandingan hasil antara alternatif kegiatan'],
            ['q' => 'Q1', 'label' => 'C', 'points' => 3, 'text' => 'Berdasarkan analisis hasil (outcome) yang akan dicapai'],
            ['q' => 'Q1', 'label' => 'D', 'points' => 4, 'text' => 'Berdasarkan analisis hasil dan kemampuan menghasilkan hasil (outcome) dan manfaat'],
            ['q' => 'Q1', 'label' => 'E', 'points' => 5, 'text' => 'Dibantu teknologi informasi untuk analisis hasil'],

            // Q2
            ['q' => 'Q2', 'label' => 'A', 'points' => 1, 'text' => 'Pengendalian dilakukan minimal 1 (satu) kali dalam 1 tahun'],
            ['q' => 'Q2', 'label' => 'B', 'points' => 2, 'text' => 'Pengendalian dilakukan minimal 2 (dua) kali dalam 1 tahun'],
            ['q' => 'Q2', 'label' => 'C', 'points' => 3, 'text' => 'Pengendalian dilakukan minimal 3 (tiga) kali dalam 1 tahun'],
            ['q' => 'Q2', 'label' => 'D', 'points' => 4, 'text' => 'Pengendalian dilakukan secara berkala sesuai kebutuhan organisasi'],
            ['q' => 'Q2', 'label' => 'E', 'points' => 5, 'text' => 'Pengendalian dilakukan menggunakan teknologi informasi (digitalisasi)'],

            // Q3
            ['q' => 'Q3', 'label' => 'A', 'points' => 1, 'text' => 'Tidak ada proses penjaminan mutu'],
            ['q' => 'Q3', 'label' => 'B', 'points' => 2, 'text' => 'Ada proses penjaminan mutu namun hanya dokumentasi'],
            ['q' => 'Q3', 'label' => 'C', 'points' => 3, 'text' => 'Ada proses penjaminan mutu dan pelaksanaan penjaminan mutu'],
            ['q' => 'Q3', 'label' => 'D', 'points' => 4, 'text' => 'Ada proses penjaminan mutu, pelaksanaan, evaluasi, dan perbaikan'],
            ['q' => 'Q3', 'label' => 'E', 'points' => 5, 'text' => 'Ada proses penjaminan mutu berbasis teknologi informasi'],

            // Q4 (only A-D)
            ['q' => 'Q4', 'label' => 'A', 'points' => 1, 'text' => 'Tidak ada SOP'],
            ['q' => 'Q4', 'label' => 'B', 'points' => 2, 'text' => 'Ada SOP namun tidak lengkap'],
            ['q' => 'Q4', 'label' => 'C', 'points' => 3, 'text' => 'Ada SOP lengkap, namun belum diterapkan secara konsisten'],
            ['q' => 'Q4', 'label' => 'D', 'points' => 4, 'text' => 'Ada SOP lengkap dan diterapkan secara konsisten'],

            // Q5
            ['q' => 'Q5', 'label' => 'A', 'points' => 1, 'text' => 'Tidak ada rencana pengembangan kompetensi'],
            ['q' => 'Q5', 'label' => 'B', 'points' => 2, 'text' => 'Ada rencana namun tidak berdasarkan kebutuhan jabatan'],
            ['q' => 'Q5', 'label' => 'C', 'points' => 3, 'text' => 'Ada rencana berdasarkan kebutuhan jabatan, namun belum terukur'],
            ['q' => 'Q5', 'label' => 'D', 'points' => 4, 'text' => 'Ada rencana berdasarkan kebutuhan jabatan dan terukur'],
            ['q' => 'Q5', 'label' => 'E', 'points' => 5, 'text' => 'Rencana pengembangan kompetensi berbasis sistem informasi'],

            // Q6
            ['q' => 'Q6', 'label' => 'A', 'points' => 1, 'text' => 'Tidak ada analisis kebijakan'],
            ['q' => 'Q6', 'label' => 'B', 'points' => 2, 'text' => 'Ada analisis namun tidak terdokumentasi'],
            ['q' => 'Q6', 'label' => 'C', 'points' => 3, 'text' => 'Ada analisis terdokumentasi namun belum digunakan dalam pengambilan keputusan'],
            ['q' => 'Q6', 'label' => 'D', 'points' => 4, 'text' => 'Analisis digunakan dalam pengambilan keputusan dan dievaluasi'],
            ['q' => 'Q6', 'label' => 'E', 'points' => 5, 'text' => 'Analisis kebijakan menggunakan data dan teknologi informasi'],

            // Q7
            ['q' => 'Q7', 'label' => 'A', 'points' => 1, 'text' => 'Tidak ada pengelolaan sumber daya khusus'],
            ['q' => 'Q7', 'label' => 'B', 'points' => 2, 'text' => 'Ada pengelolaan namun tidak terdokumentasi'],
            ['q' => 'Q7', 'label' => 'C', 'points' => 3, 'text' => 'Ada pengelolaan terdokumentasi namun tidak terukur'],
            ['q' => 'Q7', 'label' => 'D', 'points' => 4, 'text' => 'Ada pengelolaan terdokumentasi, terukur, dan dievaluasi'],
            ['q' => 'Q7', 'label' => 'E', 'points' => 5, 'text' => 'Pengelolaan sumber daya menggunakan sistem informasi'],

            // Q8
            ['q' => 'Q8', 'label' => 'A', 'points' => 1, 'text' => 'Tidak ada pengelolaan risiko'],
            ['q' => 'Q8', 'label' => 'B', 'points' => 2, 'text' => 'Ada identifikasi risiko namun tidak terdokumentasi'],
            ['q' => 'Q8', 'label' => 'C', 'points' => 3, 'text' => 'Ada identifikasi dan mitigasi risiko terdokumentasi'],
            ['q' => 'Q8', 'label' => 'D', 'points' => 4, 'text' => 'Pengelolaan risiko dilakukan berkala dan dievaluasi'],
            ['q' => 'Q8', 'label' => 'E', 'points' => 5, 'text' => 'Pengelolaan risiko berbasis teknologi informasi'],

            // Q9
            ['q' => 'Q9', 'label' => 'A', 'points' => 1, 'text' => 'Pengukuran kinerja tidak dilakukan'],
            ['q' => 'Q9', 'label' => 'B', 'points' => 2, 'text' => 'Pengukuran kinerja dilakukan namun tidak teratur'],
            ['q' => 'Q9', 'label' => 'C', 'points' => 3, 'text' => 'Pengukuran dilakukan teratur dan terdokumentasi'],
            ['q' => 'Q9', 'label' => 'D', 'points' => 4, 'text' => 'Pengukuran, evaluasi, dan perbaikan dilakukan secara berkala'],
            ['q' => 'Q9', 'label' => 'E', 'points' => 5, 'text' => 'Pengukuran kinerja menggunakan dashboard/sistem informasi'],

            // Q10
            ['q' => 'Q10', 'label' => 'A', 'points' => 1, 'text' => 'Tidak ada upaya pengembangan inovasi'],
            ['q' => 'Q10', 'label' => 'B', 'points' => 2, 'text' => 'Ada ide inovasi namun tidak terdokumentasi'],
            ['q' => 'Q10', 'label' => 'C', 'points' => 3, 'text' => 'Ada inovasi terdokumentasi namun belum terukur dampaknya'],
            ['q' => 'Q10', 'label' => 'D', 'points' => 4, 'text' => 'Inovasi terukur, dievaluasi, dan ditingkatkan'],
            ['q' => 'Q10', 'label' => 'E', 'points' => 5, 'text' => 'Inovasi didukung sistem informasi/teknologi'],

            // Q11
            ['q' => 'Q11', 'label' => 'A', 'points' => 1, 'text' => 'Budaya organisasi tidak diterapkan'],
            ['q' => 'Q11', 'label' => 'B', 'points' => 2, 'text' => 'Budaya organisasi diterapkan secara informal'],
            ['q' => 'Q11', 'label' => 'C', 'points' => 3, 'text' => 'Budaya organisasi diterapkan dan terdokumentasi'],
            ['q' => 'Q11', 'label' => 'D', 'points' => 4, 'text' => 'Budaya organisasi diterapkan, dievaluasi, dan diperbaiki'],
            ['q' => 'Q11', 'label' => 'E', 'points' => 5, 'text' => 'Budaya organisasi didukung sistem/teknologi untuk monitoring'],
        ];

        foreach ($options as $opt) {
            $question = Question::where('code', $opt['q'])->first();
            Option::updateOrCreate(
                ['question_id' => $question->id, 'label' => $opt['label']],
                ['option_text' => $opt['text'], 'points' => $opt['points']]
            );
        }

        // ── Period 2026 ──
        Period::updateOrCreate(
            ['year' => 2026],
            [
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'is_active' => true,
                'token' => Str::random(32),
            ]
        );
    }
}
