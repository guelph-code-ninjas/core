@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Current Assignments</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Assignment Name</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Similarity Score</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Assignment 1</td>
                                <td>April 12, 2017</td>
                                <td>Active</td>
                                <td>n/a</td>                           
                            </tr>
                            <tr>
                                <td>Assignment 2</td>
                                <td>April 12, 2017</td>
                                <td>Active</td>                            
                                <td>n/a</td>                           
                            </tr>
                            <tr>
                                <td>Assignment 3</td>
                                <td>May 12, 2017</td>
                                <td>Active</td>  
                                <td>n/a</td>                                                     
                            </tr>
                        </tbody>
                    </table>
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection
