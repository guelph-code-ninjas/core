@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel-heading" style="font-size: 20px; font-weight: 800">File Validation</div>
            <hr style="margin-top:0px">
            <p>Looking for: zip files</p>
            <strong>Result:</strong><br>
            <p>{{$result}}</p><br><br>
        </div>                
    </div>
</div>
@endsection