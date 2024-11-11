<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class HomepageController extends Controller
{
    public function index()
    {
        return view('homepage.index');
    }
    public function informasi()
    {
        return view('homepage.informasi');
    }
    public function metode()
    {
        return view('homepage.metode');
    }
    public function kontak()
    {
        return view('homepage.kontak');
    }
}