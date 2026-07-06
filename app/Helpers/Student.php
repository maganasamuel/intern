<?php

namespace App\Helpers;

class Student
{
    public $name;

    public $dob;

    public $address;

    public function __construct($name, $dob, $address)
    {
        $this->name = $name;
        $this->dob = $dob;
        $this->address = $address;
    }

    public function login_to_lesson($lesson)
    {
        echo "{$this->name} has logged in to lesson {$lesson}.<br><br>";
    }

    public function logout_to_lesson()
    {
        echo "{$this->name} has logged out to lesson.<br><br>";

        $this->go_home();
    }

    private function go_home()
    {
        echo "{$this->name} will now go home.<br><br>";
    }
}
