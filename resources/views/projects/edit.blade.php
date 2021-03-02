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
                Edit Project
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
                <form method="post" action="{{ route('projects.update', $project->id ) }}">
                    <div class="form-group">
                        @csrf
                        @method('PUT')
                        <label for="name">Project Name:</label>
                        <input type="text" class="form-control" name="name" value="{{ $project->name }}"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" name="description" value="{{ $project->description }}"/>
                    </div>
                    <div class="form-group">
                        <label for="startDate">Start date:</label>
                        <input type="date" class="form-control" name="startDate" value="{{ $project->startDate }}"/>
                    </div>
                    <div class="form-group">
                        <label for="duration">Duration:</label>
                        <input type="time" class="form-control" name="duration" value="{{ $project->duration }}"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection