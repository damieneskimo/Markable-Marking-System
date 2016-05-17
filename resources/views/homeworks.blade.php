@extends('layouts.app')

@section('content')

<div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-offset-1 col-md-10 marking-name">
                <h2 style="display: inline-block;">{{ $user->name }}</h2>
                @if(auth()->user()->id == $user->id)
                    <h2 class="pull-right create-new">
                        <a href="{{ url('/homework/create') }}">
                            Create New Homework
                        </a>
                    </h2>
                @endif
            </div>
        </div>

        <!-- message block -->
        @include('includes.messages')

        <!-- flash message including delete homework and comment -->
        @include('flash::message')

        <!-- pagination -->
        <div class="text-center">{{ $homeworks->links() }}</div>

        @foreach($homeworks as $homework)
            @if($homework)            
                <div class="row">
                    <div class="col-xs-12 col-md-offset-2 col-md-8 homework">
                        <div class="work">
                            <h2 style="display: inline-block;">
                                {{ $homework->title }}
                            </h2>
                            <!-- mark if any -->
                            @if(auth()->user()->id == $user->id || auth()->user()->is_tutor)
                                @if($homework->mark()->first()) 
                                    <span class="label label-primary mark-span"> 
                                    {{ $homework->mark()->first()->mark }}
                                    </span>
                                @else
                                    <span class="label label-primary mark-span hidden"></span>
                                @endif
                            @endif

                            <!-- homework content -->
                            <div>
                                {!! $homework->content !!}
                            </div>
                            <!-- user eidt and delete section -->
                            @if(auth()->user()->id == $user->id)
                                <div>
                                    <a href="{{ action('HomeworkController@edit', ['homework_id' => $homework->id]) }}"><button class="btn btn-success">Edit</button></a>
                                    <a href="{{ action('HomeworkController@destroy', ['homework_id' => $homework->id]) }}"><button class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button></a>
                                </div>
                             @endif
                            <!-- feedback -->
                            @if(auth()->user()->is_tutor)
                                <div class="feedback">
                                    <form class="form-horizontal" action="#">
                                        <select class="form-control template" style="display: inline-flex; width: 30%; margin-right: 1em;">
                                            <option>Perfect!</option>
                                            <option>Well done!</option>
                                            <option>Good enough!</option>
                                            <option>Keep practicing!</option>
                                            <option>Not quite well! Try again!</option>
                                        </select>
                                        <input type="hidden" class="homework_id" name="homework_id" value="{{ $homework->id }}">
                                        <input type="hidden" class="user_id" name="user_id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-success mark" style="display: inline-flex;">Mark</button>
                                    </form>
                                </div> <!-- .feedback -->
                            @endif
                        </div> <!-- .work -->

                        <!-- comment -->
                        <div class="comment">
                            @foreach($homework->comments()->get() as $comment)
                            <!-- dd($homework->comments()) -->
                               
                                @if($comment && $comment->homework_id == $homework->id)
                                    <blockquote id="comment-{{ $comment->id }}" 
                                        @if($comment->user_id == $homework->user_id)
                                        class="owner-comment"
                                        @endif 
                                    >
                                        <p>{{ $comment->content }}</p>
                                        <footer>

                                        @if($comment->user_id == $homework->user_id)
                                            <span>( Owner )</span>
                                        @endif
                                        {{ App\User::where('id', $comment->user_id)->first()->name }} on <span id="update-time">{{ $comment->updated_at }}</span>
                                        </footer>
                                        <!-- comment owner eidt and delete section -->
                                        @if(auth()->user()->id == $comment->user_id)
                                            <div>
                                                <button class="btn btn-success btn-xs btn-comment-edit" value="{{ $comment->id }}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                                                <button class="btn btn-danger btn-xs btn-comment-delete" value="{{ $comment->id }}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                            </div>
                                         @endif
                                    </blockquote>

                                    <!-- comment modal -->
                                    @include('includes.edit_comment_modal')

                                @endif<!-- $comment->homework_id = $homework->id -->
                            
                            @endforeach  <!-- $comments -->
                            
                            <!-- where the new comment will be injected -->
                            <blockquote class="new-comment hidden">
                                <p></p>
                                <footer class="clear-float">
                                    <span></span> on <span></span>
                                </footer>
                            </blockquote>
                            
                            <!-- validation errors -->
                            <div class="alert alert-danger info-error" style="display:none;">
                                <ul></ul>
                            </div>

                            <form class="form-comment" action="#">
                                <textarea class="form-control content" rows="5" name="content"></textarea>
                                <input type="hidden" class="homework_id" name="homework_id" value="{{ $homework->id }}">
                                <input type="hidden" class="user_id" name="user_id" value="{{ auth()->user()->id }}">
                                <button type="submit" class="btn btn-success btn-comment pull-right">Comment</button>
                            </form>

                        </div> <!-- .comment -->
                    </div> <!-- .homework -->

                    
                </div> <!-- /.row -->
            @endif
        @endforeach  <!-- /$homeworks -->

        <!-- pagination -->
        <div class="text-center clear-float">{{ $homeworks->links() }}</div>
        
</div> <!-- container-fluid -->


<!-- info modal -->
<div id="info-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="alert alert-info text-center" role="info">
                <p style="font-size: 1.5em;"></p>
            </div>
        </div>
    </div>
</div>


@endsection <!-- content -->
