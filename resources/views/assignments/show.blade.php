@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-heading" style="font-size: 20px; font-weight: 800">{{$cName}}</div>
            <hr style="margin-top:0px">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 20px; font-weight: 800">{{$aName}}</div>
                <div class="panel-body">
                    
                    <strong>Description:</strong><br>
                    {{$aDescription}}<br><br>

                    <strong>Similarity Acceptance Threshold:</strong><br>
                    {{$aSimilarity}}%<br><br>

                    <strong>Assignment Created:</strong><br>
                    {{$aStart}}<br><br>

                    <strong>Deadline:</strong><br>
                    {{$aDue}}

                </div>
                <div class="panel-heading" style="font-size: 20px; font-weight: 800">Submission Details</div>
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

                    <center><button class="btn btn-success" type="button" data-toggle="collapse" data-target="#submission" style="margin-top:10px; margin-bottom:10px; width: 100%">Submit Assignment</button></center>

                    <form method="POST" role="form" action="{{ action('FileController@test', $course) }}">
                        <div id="submission" class="collapse">
                            <div class="form-group">
                                <label for="submissionName">Submission Name</label>
                                <input type="text" name="sName" class="form-control" value="{{ old('sName') }}" id="submissionName" required>
                            </div>
                            <div class="form-group">
                                <label for="inputFile">Upload a document</label>
                                <input type="file" class="form-control-file" id="inputFile" multiple>
                                <ul id="fileList">
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="submissionComments">Submission Comments</label>
                                <textarea class="form-control" name="sComments" id="submissionComments" placeholder="Description of the assignment..." cols="30" rows="5" required>{{ Input::old('sComments') }}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection