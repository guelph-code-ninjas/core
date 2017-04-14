@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
            <br><br><h2>Success</h2>
            <p style="font-size:20px">The course has been successfully updated.</p>
            <a class="btn btn-primary" href="{{ route('coursePage', ['course' => $course]) }}" role="button">Back to Course</a>
            <br><br>
        </div>
    </div>
</div>


@endsection
