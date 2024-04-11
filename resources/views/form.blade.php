@extends('layouts.app')
@section('title', 'create')
@section('content')
    <h2 class="text text-center py-2">Add new product</h2>
    <form method="POST" action="/insert" enctype="multipart/form-data">
        @csrf


        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>


        @error('title')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror


        <div class="form-group">
            <label for="content">Detail</label>
            <textarea name="content" cols="30" rows="5" class="form-control" >{{ old('content') }}</textarea>
        </div>


        @error('content')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror


        <div class="form-group">
            <label for="price">price</label>
            <input type="number" step="any" name="price" class="form-control" value="{{ old('price') }}" >
        </div>


        @error('price')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror


        <div class="form-group">
            <label for="category">category</label>
            <input type="text" name="category" class="form-control" value="{{ old('category') }}" >

        </div>


        @error('category')
            <div class="my-2">
                <span class="text text-danger">{{$message}}</span>
            </div>
        @enderror



        <div class="mb-3">
            <label id="imageLabel" style="display: none;">Current Image</label><br>
            <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 200px; display: none; margin-top: 20px;">
            <hr>
            <label>Upload Image</label>
            <input type="file" name="image" id="image" class="form-control" onchange="previewImage();">
        </div>

        <input type="submit" value="Save" class="btn btn-primary my-3">
        <a href="{{ route('blog') }}" class="btn btn-success">All Products</a>
    </form>


    <script>
        function previewImage() {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('imagePreview');
                var label = document.getElementById('imageLabel');
                preview.src = e.target.result;
                preview.style.display = 'block';
                label.style.display = 'inline';
            }
            reader.readAsDataURL(document.getElementById('image').files[0]);
        }
    </script>
@endsection
