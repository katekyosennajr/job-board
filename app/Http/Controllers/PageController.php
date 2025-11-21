<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class PageController extends Controller
{
    public function privacy()
    {
        return Inertia::render('Privacy', [
            'auth' => [
                'user' => auth()->user()
            ]
        ]);
    }

    public function terms()
    {
        return Inertia::render('Terms', [
            'auth' => [
                'user' => auth()->user()
            ]
        ]);
    }
}
