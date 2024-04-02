@extends('layouts.app')
@section('title', 'create')
@section('content')
    <h2 class="text text-center py-2">Add new product</h2>
    <form method="POST" action="/insert" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        @error('title')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror
        <div class="form-group">
            <label for="content">Detail</label>
            <textarea name="content" cols="30" rows="5" class="form-control"></textarea>
        </div>
        @error('content')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror
        <div class="mb-3">
            <label > upload file/image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <input type="submit" value="Save" class="btn btn-primary my-3">
        <a href="/blog" class="btn btn-success">All products</a>
    </form>
@endsection
