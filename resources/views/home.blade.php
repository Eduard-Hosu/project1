@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hello {{ auth()->user()->username }}!</div>
                <div class="card-body d-flex justify-content-center">
                    Change begins at the end of your comfort zone.
                    <strong>-Roy T. Bennett</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
