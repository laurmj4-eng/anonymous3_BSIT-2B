<?php
namespace App\Controllers;

use App\Models\TeacherModel;
use App\Models\SubjectModel; // <--- THIS LINE IS CRITICAL
use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        $teacherModel = new TeacherModel();
        $subjectModel = new SubjectModel();
        
        
        // Count the records in the database
        $data = [
            'total_teachers' => $teacherModel->countAllResults(),
            'total_subjects' => $subjectModel->countAllResults(),
            
            // Placeholders for when you build the other modules later
            'total_students' => 1250, 
            'total_users'    => 45,   
        ];

        return view('dashboard/index', $data);
    }
}