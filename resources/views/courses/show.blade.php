@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="header" align="center">
                <h1>{{$courseID}}</h1>
            </div>

            {{-- Current Assignment Panel --}}
            <div class="panel panel-info">
                <div class="panel-heading">Current Assignments</div>

                <div class="panel-body">
                    <ul class="list-group">
                        @foreach( $assignments as $assignment)
                            {{--<p> {{$assignment->name}} </p>--}}
                            <a href="#" class="list-group-item">
                                <h4 class="list-group-item-heading">{{$assignment->name}}</h4>
                                <p class="list-group-item-text">Due: {{$assignment->due}}</p>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- End Current Assignment Panel --}}

            {{-- Past Assignment Panel --}}
            <div class="panel panel-info">
                <div class="panel-heading">Past Assignments</div>

                <div class="panel-body">
                    <ul class="list-group">
                        @foreach( $assignments as $assignment)
                            {{--<p> {{$assignment->name}} </p>--}}
                            <a href="#" class="list-group-item">
                                <h4 class="list-group-item-heading">{{$assignment->name}}</h4>
                                <p class="list-group-item-text">Due: {{$assignment->due}}</p>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- End Past Assignment Panel --}}


        </div>
    </div>
</div>
@endsection
