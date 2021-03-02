@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container">
    <div class="justify-content-center">
        <div class="card uper">
            <div class="card-header">
                Edit 
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ route('tasks.update', $task->id ) }}">
                    <div class="form-group">
                        @csrf
                        @method('PUT')
                        <label for="name">Task Name:</label>
                        <input type="text" class="form-control" name="name" value="{{ $task->name }}"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" name="description" value="{{ $task->description }}"/>
                    </div>
                    <div class="form-group">
                        <label for="user_id">Assign:</label>
                        <select name='user_id' class="custom-select">
                            @foreach ($users as $name => $id)
                                <option value='{{ $id }}'>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="project_id">Project:</label>
                        <select name='project_id' class="custom-select">
                            @foreach ($projects as $name => $id)
                                <option value='{{ $id }}'>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for='status'>Status:</label>
                        <select name='status' class="custom-select">
                            <option value={{ $task->status }} selected>{{ $task->status }}</option>
                            <option value='toDo'>toDo</option>
                            <option value='inProgress'>inProgress</option>
                            <option value='done'>done</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection