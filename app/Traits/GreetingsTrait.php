<?php

namespace App\Traits;

use Illuminate\Http\Request;

 /**
     * @param Request $request
     * @return $this|false|string
     */

trait GreetingsTrait{

   
        // public $hour;


    public function greetings(){

        $hour= date('H');

        if ($hour >= 20) {
           return $greetings = "Good Night";
        } elseif ($hour > 17) {
           return $greetings = "Good Evening";
        } elseif ($hour > 11) {
        return $greetings = "Good Afternoon";
        } elseif ($hour < 12) {
          return $greetings = "Good Morning";
        }

    }

}

?>