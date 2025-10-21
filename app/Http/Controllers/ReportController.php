<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $subjects = ['toan', 'ngu_van', 'ngoai_ngu', 'vat_li', 'hoa_hoc', 'sinh_hoc', 'lich_su', 'dia_li', 'gdcd'];

        $data = [];

        foreach ($subjects as $subject) {
            $data[$subject] = [
                'gioi' => DB::table('students')->where($subject, '>=', 8)->count(),
                'kha' => DB::table('students')->whereBetween($subject, [6, 7.99])->count(),
                'trungbinh' => DB::table('students')->whereBetween($subject, [4, 5.99])->count(),
                'yeu' => DB::table('students')->where($subject, '<', 4)->count(),
            ];
        }

        return view('report', compact('data'));
    }
}
