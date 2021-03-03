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
            @if ($projects->isEmpty())
                <h1>No projects, yet!</h1>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Start Date</td>
                        <td>Description</td>
                        <td>Duration</td>
                        <td colspan="2">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{$project->id}}</td>
                            <td>{{$project->name}}</td>
                            <td>{{$project->startDate}}</td>
                            <td>{!! \Illuminate\Support\Str::words($project->description, 2,'....')  !!}</td>
                            <td>{{$project->duration}}</td>
                            <td>
                                <form action="{{ route('projects.destroy', $project->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-primary" href="{{ route('projects.edit', $project->id)}}">Edit</a>
                            
                            
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class='d-flex justify-content-center'>
                    {!! $projects->links() !!}
                </div>
            @endif
        <div>
    </div>
</div>
@endsection