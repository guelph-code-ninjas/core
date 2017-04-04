@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-heading" style="font-size: 20px; font-weight: 800">{{$cName}}</div><hr style="margin-top:0px">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 20px; font-weight: 800">{{$aName}}</div>
                <div class="panel-body">
                    
                    <strong>Description:</strong><br>
                    {{$aDescription}}<br><br>

                    <strong>Similarity Acceptance Threshold:</strong><br>
                    30%<br><br>

                    <strong>Deadline:</strong><br>
                    {{$aDue}}

                </div>
                <div class="panel-heading" style="font-size: 20px; font-weight: 800">Submission Details</div><hr style="margin:0px">
                <div class="panel-body">
                    Similarity<br>
                    Errors in files etc.<br>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Submissions</div>
                <div class="panel-body">
                    <strong>Previous submissions</strong><br>
                    <a href="#">Assignment 1</a><br>
                    <a href="#">Research Paper</a><br>
                    <form>
                        <center><button class="btn btn-primary" type="submit" style="margin-top:10px; width: 100%">Submit New Assignment</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection