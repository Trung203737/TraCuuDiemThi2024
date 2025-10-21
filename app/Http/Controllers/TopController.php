<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class TopController extends Controller
{
    public function index()
    {
        // trong bảng đã có cột total_group_a (tính sẵn trong seeder)
        $students = Student::select('registration_number', 'toan', 'vat_li', 'hoa_hoc', 'total_group_a')
            ->orderByDesc('total_group_a')
            ->take(10)
            ->get();
        return view('top_group_a', compact('students'));
    }
}
