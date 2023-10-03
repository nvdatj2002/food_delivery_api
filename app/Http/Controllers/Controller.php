<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;
use PhpParser\Node\Expr\List_;

class Controller extends BaseController
{
    //
    public function getAllProducts(){
        
        return array("Iphone","ipad");
    }
    

    
}
