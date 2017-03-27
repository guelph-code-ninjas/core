@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Repository: {{ $name }} </div>

                <div class="panel-body">
                    Information
                </div>

                @include('repositories.tree', ['tree' => $tree])


            </div>
        </div>
    </div>
</div>
@endsection
