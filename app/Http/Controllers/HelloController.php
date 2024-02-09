<?php
// pengidentifikasi file berada dilokosi mana
namespace App\Http\Controllers;

// use berfungssi
use Illuminate\Http\Request;

// hellocontroller merupakan kelas turunan atau chlid class dari class controller
class HelloController extends Controller
{
    function index() {
        echo 'hallo semua';
    }

    function world() {
        echo "world";
    }
}
