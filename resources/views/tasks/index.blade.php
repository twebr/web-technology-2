@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('name') }}">
                            </div>
                        </div>

                        <!-- Task Deadline -->
                        <div class="form-group">
                            <label for="task-deadline" class="col-sm-3 control-label">Deadline</label>

                            <div class="col-sm-6">
                                <input type="text" name="deadline" id="task-deadline" class="form-control" value="{{ old('deadline') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks_today) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
                    </div>

                    <div class="panel-body">

                    </div>
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    Current tasks
                </div>
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"><a href="#past" aria-controls="home" role="tab" data-toggle="tab">Past</a></li>
                        <li role="presentation" class="active"><a href="#today" aria-controls="profile" role="tab" data-toggle="tab">Today</a></li>
                        <li role="presentation"><a href="#future" aria-controls="messages" role="tab" data-toggle="tab">Later</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane" id="past">
                            <table class="table table-striped task-table">
                                <tbody>
                                    @foreach ($tasks_past as $task)
                                        <tr>
                                            <!-- Task name -->
                                            <td class="table-text"><div>{{ $task->name }}</div></td>

                                            <!-- Task deadline -->
                                            <td class="table-text"><div>{{ date('j M Y', strtotime($task->deadline)) }}</div></td>

                                            <!-- Task Delete Button -->
                                            <td class="text-right">
                                                <form action="{{url('task/' . $task->id)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-primary">
                                                        <i class="fa fa-check" aria-hidden="true"></i> Done
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane active" id="today">
                            <table class="table table-striped task-table">
                                <tbody>
                                    @foreach ($tasks_today as $task)
                                        <tr>
                                            <!-- Task name -->
                                            <td class="table-text"><div>{{ $task->name }}</div></td>



                                            <!-- Task Delete Button -->
                                            <td class="text-right">
                                                <form action="{{url('task/' . $task->id)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-primary">
                                                        <i class="fa fa-check" aria-hidden="true"></i> Done
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" class="tab-pane" id="future">
                            <table class="table table-striped task-table">
                                <tbody>
                                    @foreach ($tasks_future as $task)
                                        <tr>
                                            <!-- Task name -->
                                            <td class="table-text"><div>{{ $task->name }}</div></td>

                                            <!-- Task deadline -->
                                            <td class="table-text"><div>{{ date('j M Y', strtotime($task->deadline)) }}</div></td>

                                            <!-- Task Delete Button -->
                                            <td class="text-right">
                                                <form action="{{url('task/' . $task->id)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-primary">
                                                        <i class="fa fa-check" aria-hidden="true"></i> Done
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- closing .tab-content-->
                </div><!-- closing .panel-body -->
            </div><!-- closing .panel -->

        </div><!-- closing .col -->
    </div><!-- closing .container -->




@endsection

@section('scripts')

    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
    $('#task-deadline').datepicker({
        format: "dd-mm-yyyy",
        todayHighlight: true,
        weekStart: 1
    });

    </script>

@endsection
