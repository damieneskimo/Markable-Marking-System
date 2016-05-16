<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the list of students
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::where('is_tutor', 0)
                        ->orderBy('name', 'asc')
                        ->paginate(6);
                        // ->get();

        return view('students', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);

        $homeworks = $user->homeworks()
                        ->orderBy('id', 'desc')
                        ->paginate(2);
                                // ->get();

        if(!$homeworks) {
            return null;
        }
                                
        // return $homeworks;

        return view('homeworks', [
            'user'      => $user,
            'homeworks' => $homeworks,
        ]);        
    }

}
