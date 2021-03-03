@extends('layouts.app')
 
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container">
    <div class="justify-content-center">
        <div class="uper">
            @if(session()->get('success'))
                <div class="alert alert-success">
                {{ session()->get('success') }}  
                </div><br />
            @endif
            @if (empty($tasks->id))
                <h1>No tasks, yet</h1>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Project</td>
                        <td>Assigned</td>
                        <td colspan="2">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{$task->id}}</td>
                            <td>{{$task->name}}</td>
                            <td>{!! \Illuminate\Support\Str::words($task->description, 2,'...')  !!}</td>
                            <td>{{$task->project->name}}</td>
                            <td>{{$task->user->name}}</td>
                            @if (Auth::user()->is_admin == 1)
                                <td>
                                    <form action="{{ route('tasks.destroy', $task->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-info" href="{{ route('tasks.show', $task->id) }}">Show</a>
                                        <a class="btn btn-primary" href="{{ route('tasks.edit', $task->id)}}">Edit</a>
                                
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            @else
                                <td>
                                    <form action="{{ route('tasks.show', $task->id)}}" method="post">
                                        @csrf
                                        <button class="btn btn-info" type="submit">Show</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class='d-flex justify-content-center'>
                    {!! $tasks->links() !!}
                </div>
            @endif
        <div>
    </div>
</div>
@endsection