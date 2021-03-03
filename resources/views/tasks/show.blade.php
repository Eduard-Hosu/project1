@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="container">
    <div class="justify-content-center">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-left">
                    <h3>Show</h3>
                </div>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('tasks.index') }}"> Back</a>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $task->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    {{ $task->description }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Project:</strong>
                    {{ $task->project->name }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select data-id="{{ $task->id }}" name='status' class="custom-select">
                        <option value='{{ $task->status }}'>{{ $task->status }}</option>
                        @foreach ($array as $status)
                            <option value='{{ $status }}'>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Assigned:</strong>
                    {{ $task->user->name }}
                </div>
            </div>
        </div>
    </div>

    <hr />

    <h4>Display Comments</h4>
    <hr />

    <h4>Add comment</h4>

    <form class='mb-4' method="post" action="{{ route('comments.store') }}">
        @csrf
        <div class="form-group">
            <textarea class="form-control" name="body"></textarea>
            <input type="hidden" name="task_id" value="{{ $task->id }}" />
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
        </div>
        <button type="submit" class="btn btn-primary">Add new comment</button>
    </form>
    @if ($comments)
        @foreach($comments as $comment)
            <div class="display-comment">
                <strong>{{ $comment->user->name }}</strong>
                <small>{{ $comment->created_at->diffForHumans() }}</small>
                <p>{{ $comment->body }}</p>
            </div>
        @endforeach
        <div class='d-flex justify-content-center'>
            {!! $comments->links() !!}
        </div>
    @endif
    
</div>
<script>
    $(function() {
        $('.custom-select').change(function() {
            var status = $(this).val();
            var task_id = $(this).data('id');
           
            $.ajax({
                type: "GET",
                dataType: "json",
                url:"{{ route('taskStatus.get') }}",
                data: {'status': status, 'task_id': task_id},
                success: function(data){
                    console.log(data.success)
                }
            });
        })
    })
</script>
@endsection