@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="header" align="left">
                <h1>Course Settings</h1>
            </div>

            <div class="sub-header">
                <h4>Add/Remove Students to {{ $course->slug }}</h4>
            </div>

            <form role="form" method="POST" >
                

                <div class="form-group">
                    <label for="studentSelect">Select students to add to a course:</label>
                    <select multiple class="form-control" id="studentSelect" rows="10" >
                        @foreach($users as $user)
                        <option>{{ $user->name }} | {{ $user->email }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Course</button>
            </form>
        </div>
    </div>
</div>

@endsection
