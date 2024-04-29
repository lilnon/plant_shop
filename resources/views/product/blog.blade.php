<!-- resources/views/product/blog.blade.php -->

{{-- @extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div id="products-data-grid" data-products="{{ json_encode($blogs) }}"></div>

    <!-- Include compiled JavaScript file -->
    <script src="{{ mix('js/app.js') }}"></script>
@endsection --}}

@extends('layouts.app')
@section('title', 'Products')
@section('content')
    @if (count($blogs) > 0)
        <h2 class="text text-center py-2">All product</h2>
        {{-- <h1>ตัวแปรที่ส่งมา {{$test}}</h1> --}}
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Product title</th>
                    <th scope="col">Product discription</th>
                    <th scope="col">Img</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit product </th>
                    <th scope="col">Report PDF </th>
                    <th scope="col">Delete product </th>

                </tr>
            </thead>
            <tbody>

                @foreach ($blogs as $item)
                    <tr>

                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->content }}</td>
                        <td>
                            @if ($item->image)
                                <img width="100" height="50" src="{{ asset('images/' . $item->image) }}" alt="image">
                                <img src="{{$item->image}}" alt="">
                            @else
                                No Image
                            @endif
                        </td>

                        <td>{{$item->price}}</td>

                        <td>
                            @if ($item->status == true)
                                <a href="{{ route('change', $item->id) }}">
                                    <p class="btn btn-success">Verified</p>
                                </a>
                            @else
                                <a href="{{ route('change', $item->id) }}">
                                    <p class="btn btn-secondary">Unverified</p>
                                </a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <a href="{{ route('report', $item->id) }}" class="btn btn-info" target="_blank">pdf</a>
                        </td>
                        <td>
                            <a href="{{ route('delete', $item->id) }}" class="btn btn-danger"
                                onclick='return confirmDelete(event, "{{ $item->title }}")'>
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $blogs->links() }}
    @else
        <h2 class="text text-center py-2">no product in database</h2>
    @endif

    <script>
        function confirmDelete(event, title) {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "to delete '" + title + "' ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = event.target.href;
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Cancelled",
                        text: "'" + title + "  ' has not been deleted :)",
                        showConfirmButton: false,
                        icon: "error",
                        timer: 1500
                    });
                }
            });
        }
    </script>
@endsection


