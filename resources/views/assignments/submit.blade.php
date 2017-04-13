@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-heading" style="font-size: 20px; font-weight: 400">{{$cName}}: Submission successful!</div>
        </div>
        <div class="col-md-8 col-md-offset-2">
        	<div class="panel panel-default">
                <div class="panel-heading">Submission for {{$aName}}</div>
                <div class="panel-body">
                	<strong>Your are {{$test}}</strong>
                	<strong>Submission Name:</strong><br>
                	{{$sName}}<br>
                	<strong>Files:</strong><br>
                	<a href="">TEST</a><br>
                	<strong>Comments:</strong><br>
                	{{$sComments}}<br>
                	<strong>Submitted at: </strong><br>
                	{{$sTime}}<br>
                	<div style="color:{{$sRemainingColor}}">Submitted {{$sRemaining}}</div><br><br>
                	<center>
	                	<div class="form-group" style="display:inline-block">
	                		<a href="{{action('AssignmentController@show', [$course, $assignment])}}">
	                        	<button class="btn btn-primary" type="submit">Go back to Assignment</button>
	                        </a>
	                    </div>
	                    <div class="form-group" style="display:inline-block">
	                        <a href="{{action('CourseController@show', $course)}}">
	                        	<button class="btn btn-primary" type="submit">Go back to Course</button>
	                        </a>
	                    </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
