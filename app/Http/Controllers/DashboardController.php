<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Notifications\RegistrationSuccessful;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $user = User::find(1);
        // $user->notify(new RegistrationSuccessful());
        return view('dashboard', [
            'title' => 'Dashboard',
            'user' => User::all()->count(),
            'articles' => Article::all()->count(),
        ]);
    }
}
