@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <label class="btn btn-primary" for="my-file-selector">
                    <input id="my-file-selector" type="file" style="display:none;">
                         Open Document
                </label>
            </div>
        </div>


    </div>
</div>
@endsection
