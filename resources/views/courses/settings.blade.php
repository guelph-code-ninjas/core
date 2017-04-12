@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="header" align="left">
                <h1>Course Settings</h1>
            </div>

            <div class="sub-header">
                <h4>Add/Remove Students</h4>
            </div>

            <form role="form" method="POST" >
                <div class="form-group">
                    <label for="courseSelect">Select course to add students to: </label>
                    <select multiple class="form-control" id="courseSelect">
                        @foreach($courses as $course)
                        <option>{{ $course->slug }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="studentSelect">Select students to add to a course:</label>
                    <select multiple class="form-control" id="studentSelect">
                        @foreach($users as $user)
                        <option>{{ $user->name }} | {{ $user->email }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="courseDescription">Course Description:</label>
                    <textarea class="form-control" id="courseDescription" rows="6"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Course</button>
            </form>
        </div>
    </div>
</div>

@endsection
