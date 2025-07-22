<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function ValidandoAcesso(){
        if(auth()->user()->role == "cliente"){
            dd("cliente");

        }elseif(auth()->user()->role == "admin"){
            dd("admin");
        }
    }
}
