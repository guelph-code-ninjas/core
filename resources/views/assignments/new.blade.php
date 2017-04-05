@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 20px; font-weight: 400">Create New Assignment for {{$cName}}</div>
                <div class="panel-body">
                    <div class="col-md-8 col-md-offset-2" >
                        <form method="POST" role="form" action="{{ action('AssignmentController@store', $course) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="newAssignmentName">Assignment Name</label>
                                <input type="text" name="aName" class="form-control" value="{{ old('aName') }}" id="newAssignmentName" required>
                            </div>
                            <div class="form-group">
                                <label for="newAssignmentDueDate">Due Date:</label>
                                <input type="datetime-local" name="aDueDate" class="form-control" id="newAssignmentDueDate" aria-describedby="duedateHelp">
                                <small id="duedateHelp" class="form-text text-muted">YYYY-MM-DD - HH:MM - AM/PM</small>
                            </div>
                            <div class="form-group">
                                <label for="newAssignmentSimilarity">Similarity Acceptance Threshold</label>
                                <input type="range" name="aSimilarity" min="0" max="100" value="0" id="newAssignmentSimilarity" step="5" oninput="similarityUpdate(value)" required>
                                <output for="newAssignmentSimilarity" id="similarityValue"></output>
                                <label id="similarityIndicator"></label>
                            </div>
                            <label for="newAssignmentExpected">Expected File Types</label>
                            <div class="form-group control-group" id="newAssignmentExpected">
                                <label class="control control--checkbox">
                                    <input type="checkbox">
                                    .doc
                                </label>
                                <label class="control control--checkbox">
                                    <input type="checkbox" style="margin-left:8px">
                                    .docx
                                </label>
                                <label class="control control--checkbox">
                                    <input type="checkbox" style="margin-left:8px">
                                    .pdf
                                </label>
                                <label class="control control--checkbox">
                                    <input type="checkbox" style="margin-left:8px">
                                    .txt
                                </label>
                                <label class="control control--checkbox">
                                    <input type="checkbox" style="margin-left:8px">
                                    .zip
                                </label>
                                <label class="control control--checkbox">
                                    <input type="checkbox" style="margin-left:8px">
                                    .tar
                                </label>
                                <label class="control control--checkbox">
                                    <input type="checkbox" style="margin-left:8px">
                                    .tar.gz
                                </label>
                                <br>
                                <label for="newAssignmentExpectedField">Other:</label>
                                <input type="text" name="aExpected" value="{{ old('aExpected') }}" id="newAssignmentExpectedField" aria-describedby="expectedHelp">
                                <small id="expectedHelp" class="form-text text-muted">Separate each field with a comma (,)</small>
                            </div>
                            <div class="form-group">
                                <label for="newAssignmentDescription">Assignment Description</label>
                                <textarea class="form-control" name="aDescription" id="newAssignmentDescription" placeholder="Description of the assignment..." cols="50" rows="5" required>{{ Input::old('aDescription') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Expected file types required:</label>
                            </div>
                            <div class="form-group">
                                <label for="inputFile">Upload a document:</label>
                                <input type="file" class="form-control-file" id="inputFile" multiple>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function similarityUpdate(currentValue) {
    var sv = document.querySelector('#similarityValue');
    var lb = document.querySelector('#similarityIndicator');

    sv.value = currentValue;
    sv.innerHTML = sv.innerHTML + "%";
    if(currentValue < 33){
        lb.innerHTML = "Strict";
        lb.style.color = "red";
    }else if(currentValue < 66){
        lb.innerHTML = "Reasonable";
        lb.style.color = "#ffd800";
    }else{
        lb.innerHTML = "Lenient";
        lb.style.color = "green";
    }
}
</script>
@endsection
