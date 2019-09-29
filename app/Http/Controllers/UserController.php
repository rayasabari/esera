<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\RoleUser;

class UserController extends Controller
{
    public $roleuser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->roleuser = New RoleUser();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return view('pages.admin.home',compact('user'));
        }

        return view('pages.user.home',compact('user'));

        // return response()->json($role->role_id);
    }
}
