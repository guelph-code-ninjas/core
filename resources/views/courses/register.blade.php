
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('course/register')}}">
                     {{ csrf_field() }}

            			<div class="form-group">
                			<label class="control-label col-sm-4" for="course_name">Course Name:</label>
                            <div class="col-sm-4">

                                <select class="custom-select col-sm-10 form-control" id="formCustomSelect" name="courseName" value="{{ old('courseName') }}">
                                    <option selected disabled>Choose Course</option>
                                    <option value="CIS1500">CIS*1500</option>
                                    <option value="CIS1910">CIS*1910</option>
                                    <option value="CIS3110">CIS*3110</option>
                                </select>
                            </div>
                		</div>

                        <div align="center">
                            @if ($errors->has('courseName'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('courseName') }}</strong>
                                </span>
                            @endif
                        </div>

                		<div class="form-group">
                			<label for="course_semester" class="control-label col-sm-4">Semester:</label>
                            <div class="col-sm-4">
                                <select class="custom-select col-sm-10 form-control" id="formCustomSelect" for="course_semester" name="courseSemester" value="{{ old('courseSemester') }}">
                                    <option selected disabled>Choose Semester</option>
                                    <option value="S16">S16</option>
                                    <option value="F16">F16</option>
                                    <option value="W17">W17</option>
                                </select>
                            </div>
                		</div>

                        <div align="center">
                            @if ($errors->has('courseSemester'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('courseSemester') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="course_id" class="control-label col-sm-4">Section:</label>
                            <div class="col-sm-4">
                                <select class="custom-select col-sm-10 form-control" id="formCustomSelect" for="course_semester" name="courseSection" value="{{ old('courseSection') }}">
                                    <option selected disabled>Choose Section</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                </select>
                            </div>
                        </div>

                        <div align="center">
                            @if ($errors->has('courseSection'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('courseSection') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <button type="submit" class="btn btn-primary">Save Course</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
