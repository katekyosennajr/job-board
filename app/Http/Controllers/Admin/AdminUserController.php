<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->get('sortBy', 'id');
        $sortDir = $request->get('sortDir', 'asc');

        $users = User::orderBy($sortBy, $sortDir)->get();

        return Inertia::render('Admin/Users/Index', [
            'users'   => $users,
            'sortBy'  => $sortBy,
            'sortDir' => $sortDir,
        ]);
    }
}
