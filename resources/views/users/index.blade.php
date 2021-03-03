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
            @if ($users->isEmpty())
                <h1>No users, yet</h1>
            @else
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <td>ID</td>
                        <td>Username</td>
                        <td>Admin</td>
                        <td>Email</td>
                        <td colspan="2">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->username}}</td>
                            {{-- I tried to use toggle but somehow the request is not working afther that! --}}
                            <td>
                                <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Admin" data-off="User" {{ $user->is_admin ? 'checked' : '' }}>
                            </td>
                            <td>{{$user->email}}</td>
                            <td>
                                <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class='d-flex justify-content-center'>
                    {!! $users->links() !!}
                </div>
            @endif
        <div>
    </div>
</div>
<script>
    $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0; 
            var user_id = $(this).data('id'); 
            
            $.ajax({
                type: "GET",
                dataType: "json",
                url:"{{ route('status.get') }}",
                data: {'is_admin': status, 'user_id': user_id},
                success: function(data){
                    console.log(data.success)
                }
            });
        })
    })
</script>
@endsection