@extends('layout')
@section('title','about')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-5">
                <div class="card-header">
                    <h2 class="text-center">About Me</h2>
                </div>
                <div class="card-body">
                    <p class="mb-4">My name is: {{ $name }}</p>
                    <p class="mb-4">Date is: {{ $date }}</p>
                    <p>asokdosakdoskdoksaodsadkoskaodksaodko</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
