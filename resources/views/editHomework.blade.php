@extends('layouts.app')

@section('content')

	<div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-offset-2 col-md-8 marking-name">
                <h1 class="text-center">Edit Homework</h1>
        	</div>

        	<div class="col-xs-12 col-md-offset-2 col-md-8">
        		@include('includes.validation_error')
            	<form action="{{ action('HomeworkController@update', ['homework' => $homework->id]) }}" method="post" class="form-horizontal">
            		{{ method_field('patch') }}
            		<div class="form-group">
            			<div class="col-sm-2 control-label">
	                    	<label for="title" class="pull-left"><span class="">Homework Title</span></label>
	                    </div>
	                    <div class="col-sm-10">
	                    	<input class="form-control" name="title" id="title" value="{{ $homework->title }}">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="content"></label>
	                    <textarea class="form-control" name="content" id="content" rows="10">{{ $homework->content }}</textarea>
	                </div>
	                {{ csrf_field() }}
	                <button class="btn btn-success center-block" type="submit">Edit</button>
	            </form>
            </div>

            </div>
        </div>
    </div>

@endsection

@include('includes.tinyMCE')