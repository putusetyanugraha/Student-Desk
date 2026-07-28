<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\Students;

class HomeController extends Controller
{
    public function index()
    {
        $search = request('search');

        $students = Students::when($search, function ($query) use ($search) {

            $query->where('name', 'like', "%{$search}%");
        })->get();

        return view('home', compact('students'));
    }
}
