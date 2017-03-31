@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 20px; font-weight: 400">Create New Assignment</div>
                <div class="panel-body">
                    <div class="col-md-8 col-md-offset-2" >
                        
                        <form>
                            <div class="form-group">
                                <label for="newAssignmentName">Assignment Name</label>
                                <input type="text" class="form-control" id="newAssignmentName" placeholder="Ex. username@mail.uoguelph.ca" required>
                            </div>
                            <div class="form-group">
                                <label for="newAssignmentDueDate">Due Date:</label>
                                <input type="datetime-local" class="form-control" id="newAssignmentDueDate" aria-describedby="duedateHelp"/>
                                <small id="duedateHelp" class="form-text text-muted">YYYY-MM-DD - HH:MM - AM/PM</small>
                            </div>
                            <div class="form-group">
                                <label for="newAssignmentSimilarity">Similarity Acceptance Threshold</label>
                                <input type="range" min="0" max="100" value="0" id="newAssignmentSimilarity" step="5" oninput="similarityUpdate(value)">
                                <output for="newAssignmentSimilarity" id="similarityValue"></output>
                                <label id="test"></label>
                            </div>
                            <div class="form-group">
                                <label for="newAssignmentDescription">Assignment Description</label>
                                <textarea class="form-control" id="newAssignmentDescription" placeholder="Description of the assignment..." cols="50" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="inputFile">Upload a document:</label>
                                <input type="file" class="form-control-file" id="inputFile" aria-describedby="fileHelp" multiple>
                                <small id="fileHelp" class="form-text text-muted">Expected file types: .zip, .tar, .tar.gz, .rar, .doc, .docx, .pdf</small>
                            </div>
                            <div class="form-group">
                                <a class="btn btn-primary" type="submit">Create</a>
                            </div>
                        </form>

                        <script type="text/javascript">
                        function similarityUpdate(currentValue) {
                            var sv = document.querySelector('#similarityValue');
                            var lb = document.querySelector('#test');

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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
