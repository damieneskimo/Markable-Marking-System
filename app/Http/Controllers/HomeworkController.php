<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Homework;

use App\User;

use App\Mark;

use App\Comment;

use Session;


class HomeworkController extends Controller
{
    /**
    * Get the authenticated user
    */
    protected $auth_user; 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->auth_user = auth()->user();
    }

    public function index($id)
    {
    	
    }

    public function create(Homework $homework)
    {
        return view('newHomework', compact('homework'));
    }

    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required|unique:homeworks, content'
        ]);

        if($this->auth_user->is_tutor) {
            return null;
        }

        $homework = new Homework();

        $homework->user_id = $this->auth_user->id;
        $homework->title = $request['title'];
        $homework->content = $request['content'];

        $homework->save();
        // return $homework;

        Session::flash('success', 'Homework successfully created!');

        return redirect()->action('StudentsController@show', [$this->auth_user->id]);

    }

    public function destroy($homework_id)
    {
        $homework = Homework::find($homework_id);

        if($this->auth_user->id == $homework->user()->first()->id){
            $homework->delete();
        }

        flash()->overlay('Homework successfully deleted!');

        return back();
    }

    public function edit(Request $request, $homework_id)
    {

        $homework = Homework::find($homework_id);

        return view('editHomework', compact('homework'));
    }

    public function update(Request $request, $homework_id)
    {
        // validation
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required|unique:homeworks, content'
        ]);

        $homework = Homework::find($homework_id);

        if($this->auth_user->id == $homework->user()->first()->id){
            $homework->update($request->all());
        }

        return redirect()->action('StudentsController@show', [$homework->user()->first()->id]);
    }

    public function mark(Request $request)
    {
        $this->validate($request, [
            'mark' => 'required'
        ]);

        $homework_id = $request['homework_id'];
        $user_id = $request['user_id'];
        $homework_mark = $request['mark'];

        $homework = Homework::find($homework_id);

        if(!$homework) {
            return null;
        }

        $mark = $homework->mark()->first();

        if($this->auth_user->is_tutor){
            if($mark) {
                $mark->update($request->all());
            } else {
                $mark = new Mark();
                $mark->user_id = $user_id;
                $mark->homework_id = $homework_id;
                $mark->mark = $homework_mark;

                $mark->save();
            }
        }
             
        return response()->json(['mark' => $mark->mark], 200);
    }
    
}