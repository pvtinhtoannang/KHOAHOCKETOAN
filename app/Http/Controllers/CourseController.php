<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private $post_type, $course, $post_controller;

    /**
     * PageController constructor.
     */
    public function __construct()
    {
        $this->post_type = 'course';
        $this->course = new Course();
        $this->post_controller = new PostController();
    }

    function index($status = null)
    {
        return view('admin.course.course.courses');
    }

    function getCourseEditor()
    {
        return view('admin.course.course.course-editor', ['post_type' => $this->post_type]);
    }


    function createCourse(Request $request){

    }
}
