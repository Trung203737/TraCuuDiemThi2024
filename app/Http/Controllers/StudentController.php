<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Hiển thị form tra cứu
    public function index()
    {
        return view('scores');
    }

    // Xử lý tìm kiếm theo số báo danh
    public function search(Request $request)
    {
        $request->validate([
            'registration_number' => 'required|numeric',
        ], [
            'registration_number.required' => 'Vui lòng nhập số báo danh.',
            'registration_number.numeric' => 'Số báo danh chỉ được chứa chữ số.',
        ]);

        $student = Student::where('registration_number', $request->registration_number)->first();

        if (!$student) {
            return back()->with('error', 'Không tìm thấy thí sinh với số báo danh này!');
        }

        return view('scores', compact('student'));
    }
}
