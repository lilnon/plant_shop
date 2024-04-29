{{-- /* This code snippet is a Blade template in a Laravel application. Let me explain what each part of the
code does: */ --}}
@extends('layouts.app')
@section('title', 'index')

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

    {{-- /* This code snippet is responsible for displaying a list of items in a card layout. Let me break
   down what each part of the code does: */ --}}
    <div class="row container mx-auto py-2">
        @foreach ($main as $item)
            @if ($item->status)
                <div class="col-sm-3 mb-3">
                    <div class="card" style="width: 18rem;">
                        @if ($item->image)
                            <img width="100%" height="250" class="card-img-top" src="{{ asset('images/' . $item->image) }}"
                                alt="Card image cap" style="overflow:hidden">
                        @else
                            <img width="100%" height="250" class="card-img-top" src="{{ asset('images/Noimg.png') }}"
                                alt="Card image cap" style="overflow:hidden">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $item->id }} | {{ $item->title }}</h5>
                        </div>

                        <div class="card-footer bg-transparent border-0">
                            <a href="#" class="btn btn-primary show-detail" data-id="{{ $item->id }}"
                                data-title="{{ $item->title }}" data-content="{{ $item->content }}"
                                data-price="{{ $item->price }}" data-image="{{ asset('images/' . $item->image) }}">Show
                                Detail</a>
                            @if ($item->status)
                                <a class="btn btn-success">Verified</a>
                            @else
                                <a class="btn btn-warning">Unverified</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    {{ $main->links() }}

    {{-- /* The script you provided is responsible for handling the click event on elements with the class
  'show-detail'. Let me break down what each part of the script is doing: */ --}}
    <script>
        document.querySelectorAll('.show-detail').forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                event.preventDefault();

                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                const content = this.getAttribute('data-content');
                const price = this.getAttribute('data-price');
                const image = this.getAttribute('data-image');
                Swal.fire({
                    title: title + ' - ' + id,
                    html: '<img src="' + image + '" style="max-width: 100%;"><br><b>Detail</b> ' +
                        "<br>" + content + '<br><b>Price:</b> ' + price + ' baht/kk',
                    confirmButtonText: 'Close'
                });
            });
        });
    </script>

@endsection
