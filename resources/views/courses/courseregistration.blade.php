
@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		 <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Course Registration</h3>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('course/registration')}}">
                     {{ csrf_field() }}

            			<div class="form-group">
                			<label class="control-label col-sm-2" for="course_name">Course Name:</label>
                            <div class="col-sm-10">
                			    <input type="text" class="form-control" id="course_name" name="courseName" aria-describedby="nameHelp" placeholder="Enter course name" required autofocus>
                            </div>
                		</div>

                		<div class="form-group">
                			<label for="course_id" class="control-label col-sm-2">Course ID:</label>
                            <div class="col-sm-10">
                			    <input type="text" class="form-control" id="course_id" name="courseID"placeholder="Enter course ID" required>
                            </div>
                		</div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <button type="submit" class="btn btn-default">Save Course</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

