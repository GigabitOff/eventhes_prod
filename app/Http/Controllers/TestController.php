<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    public $name = 'Bob';
    public $age = '20';
    public $hobby = 'swim';

   public function __construct($ret)
    {
        $this->name = $ret;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setHobby($hobby){
       $this->hobby = $hobby;
    }

    public function getName(){
        return $this->name;
    }

}
