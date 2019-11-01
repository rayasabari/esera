<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\RoleUser;
use App\Models\Nipl;

class UserController extends Controller
{
    public  $roleuser,
            $nipl;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->roleuser = New RoleUser();
        $this->nipl     = New Nipl();
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
        $nipl = $this->nipl->where('id_user', Auth::user()->id)->first();

        if ($user->isAdmin()) {
            return view('pages.admin.home',compact('user'));
        }

        return view('pages.user.home',compact('user','nipl'));

        // return response()->json($role->role_id);
    }
}
