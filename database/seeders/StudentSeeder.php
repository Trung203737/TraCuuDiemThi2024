<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/diem_thi_thpt_2024.csv');
        if (!file_exists($path)) {
            $this->command->warn("⚠️ Không tìm thấy file CSV ở: $path");
            return;
        }

        $handle = fopen($path, 'r');
        fgetcsv($handle); // bỏ dòng header

        $batchSize = 1000; // số dòng mỗi lần insert
        $data = [];

        while (($row = fgetcsv($handle)) !== false) {
            [
                $sbd, $toan, $ngu_van, $ngoai_ngu, $vat_li,
                $hoa_hoc, $sinh_hoc, $lich_su, $dia_li,
                $gdcd, $ma_ngoai_ngu
            ] = $row;

            $data[] = [
                'registration_number' => $sbd,
                'toan' => (float)$toan,
                'ngu_van' => (float)$ngu_van,
                'ngoai_ngu' => (float)$ngoai_ngu,
                'vat_li' => (float)$vat_li,
                'hoa_hoc' => (float)$hoa_hoc,
                'sinh_hoc' => (float)$sinh_hoc,
                'lich_su' => (float)$lich_su,
                'dia_li' => (float)$dia_li,
                'gdcd' => (float)$gdcd,
                'ma_ngoai_ngu' => $ma_ngoai_ngu,
                'total_group_a' => (float)$toan + (float)$vat_li + (float)$hoa_hoc,
                'total_group_b' => (float)$toan + (float)$hoa_hoc + (float)$sinh_hoc,
                'total_group_c' => (float)$ngu_van + (float)$lich_su + (float)$dia_li,
            ];

            // Khi đủ batchSize thì insert 1 lần
            if (count($data) === $batchSize) {
                DB::table('students')->insert($data);
                $data = [];
            }
        }

        // Insert phần còn lại
        if (!empty($data)) {
            DB::table('students')->insert($data);
        }

        fclose($handle);
        $this->command->info("✅ Import thành công!");
    }
}
