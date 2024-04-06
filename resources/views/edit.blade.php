@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')
    <h2 class="text-center py-2">Edit Product</h2>
    <form method="POST" action="{{ route('update', $blog->id) }}" enctype="multipart/form-data">
        @csrf


        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
        </div>
        @error('title')
            <div class="my-2">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror

        <div class="form-group">
            <label for="content">Detail</label>
            <textarea name="content" cols="30" rows="5" class="form-control">{{ $blog->content }}</textarea>
        </div>
        @error('content')
            <div class="my-2">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="{{ $blog->price }}">
        </div>
        @error('price')
            <div class="my-2">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror

        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" name="category" class="form-control" value="{{ $blog->category }}">
        </div>
        @error('category')
            <div class="my-2">
                <span class="text-danger">{{ $message }}</span>
            </div>
        @enderror


        @if ($blog->image)
    <div class="form-group">
        <label for="current_image">Current Image</label><br>
        <img id="current_image" src="{{ asset('images/' . $blog->image) }}" alt="Current Image" style="max-width: 200px;">
    </div>
@endif

            <hr>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control" onchange="previewImage(event)">
            </div>
            @error('image')
                <div class="my-2">
                    <span class="text-danger">{{ $message }}</span>
                </div>
            @enderror

        <input type="submit" value="Save" class="btn btn-primary my-3">
        <a href="{{ route('blog') }}" class="btn btn-success">All Products</a>
    </form>
@endsection
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('current_image');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>
