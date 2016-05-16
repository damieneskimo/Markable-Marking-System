@extends('layouts.app')

@section('content')
<div class="container-fluid">

<!-- pagination -->
<div class="text-center">{{ $users->links() }}</div>

@foreach($users as $user)
    
     <div class="row">
        <div class="col-xs-6 col-md-2 col-md-offset-1">
            <a class="student-name" href="{{ action('StudentsController@show', ['id' => $user->id]) }}">
                <img class="img-responsive img-circle img-thumbnail" src="{{ $user->thumbnail }}" alt="photo of student">
            </a>
        </div>
        <div class="col-xs-6 col-md-3 name-div">
            <a class="student-name" href="{{ action('StudentsController@show', ['id' => $user->id]) }}">{{ $user->name }}</a>
        </div>
        <div class="col-xs-12 col-md-5 motto">
            <blockquote class="blockquote">
                {{ $user->motto }}
            </blockquote>
        </div>
    </div><!-- /.row -->

@endforeach

<!-- pagination -->
<div class="text-center">{{ $users->links() }}</div>
    
</div>
@endsection
