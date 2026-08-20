<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Company;
use App\Models\Enquiry;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_students' => Student::count(),
            'total_courses' => Course::count(),
            'total_companies' => Company::count(),
            'new_enquiries' => Enquiry::where('status', 'new')->count(),
        ];
        
        $recent_enquiries = Enquiry::latest()->take(5)->get();
        $recent_students = Student::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recent_enquiries', 'recent_students'));
    }
}
