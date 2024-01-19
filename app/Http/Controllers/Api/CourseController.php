<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getCourses()
    {
        $courses = Course::all();

        return response()->json(['courses' => $courses]);
    }

    public function getCourseChapters(Request $request, $id)
    {
        $courses = Course::findOrFail($id);

        return response()->json(['courses' => $courses]);
    }
}
