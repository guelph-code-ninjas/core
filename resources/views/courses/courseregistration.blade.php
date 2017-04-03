
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
                			<label class="control-label col-sm-4" for="course_name">Course Name:</label>
                            <div class="col-sm-4">
                                <select class="custom-select col-sm-10 form-control" id="formCustomSelect" name="courseName">
                                    <option selected>Choose Course</option>
                                    <option value="CIS*1500">CIS*1500</option>
                                    <option value="CIS*1910">CIS*1910</option>
                                    <option value="CIS*3110">CIS*3110</option>
                                </select>
                            </div>
                         {{--   <div class="col-sm-10">
                			    <input type="text" class="form-control" id="course_name" name="courseName" aria-describedby="nameHelp" placeholder="Enter course name" required autofocus>
                            </div> --}}
                		</div> 

                		<div class="form-group">
                			<label for="course_semester" class="control-label col-sm-4">Semester:</label>
                            <div class="col-sm-4">
                                <select class="custom-select col-sm-10 form-control" id="formCustomSelect" for="course_semester" name="courseSemester">
                                    <option selected>Choose Semester</option>
                                    <option value="S16">S16</option>
                                    <option value="F16">F16</option>
                                    <option value="W17">W17</option>
                                </select>
                            </div>
                            {{-- <div class="col-sm-10">
                			    <input type="text" class="form-control" id="course_semester" name="courseSemester"placeholder="Enter semester" required>
                            </div> --}}
                		</div>

                        <div class="form-group">
                            <label for="course_id" class="control-label col-sm-4">Section:</label>
                            <div class="col-sm-4">
                                <select class="custom-select col-sm-10 form-control" id="formCustomSelect" for="course_semester" name="courseSection">
                                    <option selected>Choose Section</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                </select>
                            </div>
                            {{--<div class="col-sm-10">
                                <input type="text" class="form-control" id="course_section" name="courseSection"placeholder="Enter section" required>
                            </div>--}}
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

