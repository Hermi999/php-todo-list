<!-- tell Blade that we use the layout app from the layouts folder -->
@extends('layouts.app')

<!-- content between section and endsection will be injected into yield of app layout -->
@section('content')
  <div class="container">
    <div class="col-sm-offset-2 col-sm-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          New Task
        </div>

        <div class="panel-body">
          <!-- Display validation errors -->
          @include('common.errors')

          <!-- New task form -->
          <form action="/task" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task name -->
            <div class="form-group">
              <label for="task" class="col-sm-3 control-label">Task</label>
              <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control">
              </div>
            </div>

            <!-- Task button -->
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-success">
                  <i class="fa fa-plus"></i> Add task
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Show Current Tasks -->
        @if (count($tasks) > 0)
          <div class="panel panel-default">
            <div class="panel-heading">
              Current Tasks
            </div>

            <div class="panel-body">
              <table class="table table-striped task-table">
                <thead>
                  <th>Task</th>
                  <th>&nbsp;</th>
                </thead>

                <tbody>
                  @foreach ($tasks as $task)
                    <tr>
                      <!-- Task Name -->
                      <td class="table-text">
                        <div>{{ $task->name }}</div>
                      </td>

                      <td>
                        <form action="/task/{{ $task->id }}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button class="btn btn-danger">Delete Task</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
      @endif

      </div>
    </div>
  </div>

@endsection