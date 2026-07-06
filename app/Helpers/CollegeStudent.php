<?php

namespace App\Helpers;

class CollegeStudent extends Student
{
    public $course;

    public function set_course($course)
    {
        $this->course = $course;
    }

    public function get_course()
    {
        echo "The course of {$this->name} is {$this->course}.<br><br>";
    }
}
