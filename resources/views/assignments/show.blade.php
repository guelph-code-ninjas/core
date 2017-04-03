@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-heading" style="font-size: 20px; font-weight: 400">Course {{$courseID}}</div><hr style="margin-top:0px">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Assignment {{$assignmentID}}</div>
                <div class="panel-body">
                    "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."
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
                    <a class="btn btn-primary" type="submit" style="margin-top:10px">Submit New Assignment</a>
                </div>

            </div>
        </div>
    </div>
    <div class="row">

    </div>
</div>
@endsection
