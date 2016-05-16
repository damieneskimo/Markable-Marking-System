<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Comment;

use App\User;

use App\Homework;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);        

        $comment = new Comment();
        $comment->homework_id = $request['homework_id'];
        $comment->user_id = $request['user_id'];
        $comment->content = $request['content'];

        $comment->save();

        $user = User::where('id', $comment->user_id)->first();
        $homework = Homework::where('id', $comment->homework_id)->first();
             
        return response()->json([
            'comment' => $comment,
            'user'    => $user,
            'homework'=> $homework,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);

        return response()->json([
            'success' => true,
            'data'    => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $comment = Comment::find($id);

        if(auth()->user()->id == $comment->user_id){

            $comment->update($request->all());

        }

        return response()->json([
            'success' => true,
            'data'    => $comment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if(auth()->user()->id == $comment->user_id){
            
            $comment->delete();

        }

        // show info
        // flash()->overlay('Comment successfully deleted!');

        return response()->json([
               'success' => true,
               'msg'     => 'Comment successfully deleted!'
        ]);
    }
}
