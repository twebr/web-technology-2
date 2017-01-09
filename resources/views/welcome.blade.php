@extends('layouts.app')

@section('content')
<div class="container">

    <div class="jumbotron">
        <h1>To Do List</h1>
        <h2>The task manager for people with deadlines</h2>
        <p>Thanks for using To Do List! This app is a simple, no-frills task manager that allows you to easily set tasks and associated deadlines.</p>
        <p><a class="btn btn-primary btn-lg" href="{{ url('/register') }}" role="button">Create an account</a></p>
    </div>


<!--     <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">To Do List – the task manager for people with deadlines</div>

                <div class="panel-body">
                    Thanks for using To Do List! This app is a simple, no-frills task managers that allows you to easily set tasks and associated deadlines.

                    Get started by <a href="{{ url('/register') }}">creating an account</a>.
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection
