@extends('layouts.app')

@section('content')
	
	<div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-offset-1 col-md-10 marking-name">
            	<img src="{{ $user->thumbnail }}" class="img-responsive img-circle" alt="user image" style="display: inline-block;">
                <h2 style="display: inline-block;">
                	{{ auth()->user()->name }}
                	@if(auth()->user()->is_tutor)
                    	( tutor )
                	@else
                		( student )
                	@endif
                </h2>
            </div>
        	<div class="col-xs-12 col-md-offset-2 col-md-8">
        		<!-- flash message including delete homework and comment -->
        		@include('flash::message')

        		<!-- include the error message -->
        		@include('includes.validation_error')
        		
                <form action="{{ url('account/update') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
	                <div class="form-group">
	                    <label for="name" class="col-sm-2 control-label">Name</label>
	                    <div class="col-sm-10">
	                    	<input type="text" name="name" class="form-control" value="{{ $user->name }}" id="name">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="email" class="col-sm-2 control-label">Email</label>
	                    <div class="col-sm-10">
	                    	<input type="text" name="email" class="form-control" value="{{ $user->email }}" id="email" disabled>
	                    </div>
	                </div>
	                <!-- <div class="form-group">
	                    <label for="password" class="col-sm-2 control-label">Password</label>
	                    <div class="col-sm-10">
	                    	<input type="password" name="password" class="form-control" value="" id="password">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="password_confirmation" class="col-sm-2 control-label">Confirm Password</label>
	                    <div class="col-sm-10">
	                    	<input type="password" name="password_confirmation" class="form-control" value="" id="password_confirmation">
	                    </div>
	                </div> -->
	                <div class="form-group">
	                    <label for="motto" class="col-sm-2 control-label">Motto</label>
	                    <div class="col-sm-10">
	                    	<input type="text" name="motto" class="form-control" value="{{ $user->motto }}" id="motto">
                    	</div>
	                </div>
	                <!-- <div class="form-group">
	                    <label for="thumbnail" class="col-sm-2 control-label">User Image (only .jpg)</label>
	                    <div class="col-sm-10">
	                    	<input type="file" name="thumbnail" class="form-control" id="thumbnail">
                    	</div>
	                </div> -->
	                <div class="form-group">
	                	<div class="col-sm-offset-2 col-sm-10">
	                		<button type="submit" class="btn btn-success">Update Account</button>
                		</div>
            		</div>
	                <input type="hidden" value="{{ Session::token() }}" name="_token">
	            </form>	
            </div>
        </div>
    </div>

@endsection