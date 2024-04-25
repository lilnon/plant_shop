@extends('layouts.app')
@section('title','category index')
@section('content')
<style>
    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .col-sm-3 {
        display: flex;
        flex: 1;
    }

    .card {
        width: 100%;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
</style>

@foreach ($main as $item)

<div class="row container mx-auto py-2">
        <div class="col-sm-3 mb-3">
            <div class="card mt-5">
                <div class="card-header">
                    <h2 class="text-center">{{$item->category}}</h2>
                </div>
                <div class="card-body">

                    <p></p>

                </div>
            </div>
        </div>
    </div>

@endforeach
@endsection
