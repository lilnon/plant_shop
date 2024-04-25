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
    {{-- $main คือก้อน array ของ data ที่ส่งมา --}}
    {{-- ใช้loop เพื่อเรียก ใช้ data ทีละตัวของ array หรือตัวแปร $main แล้วตั้งชื่อเป็น $item --}}

    <div class="row container mx-auto py-2">
        @foreach ($main as $item)
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
                        <p class="card-text">
                            @if (strlen($item->content) > 500)
                                {{ substr($item->content, 0, 500) }}<span class="more-text"
                                    style="display:none;">{{ substr($item->content, 500) }}</span>
                                <a href="#" class="show-more">Show more</a>
                            @else
                                {{ $item->content }}
                            @endif
                        </p>
                    </div>

                    <div class="card-footer bg-transparent border-0">
                        <a href="#" class="btn btn-primary ">{{ $item->price }} | baht</a>
                        @if ($item->status == true)
                            <a class="btn btn-success">Verified</a>
                        @else
                            <a class="btn btn-warning">Unverified</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $main->links() }}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.show-more').forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const moreText = this.previousElementSibling;
                    if (moreText.style.display === "none") {
                        moreText.style.display = "inline";
                        this.textContent = "Show less";
                    } else {
                        moreText.style.display = "none";
                        this.textContent = "Show more";
                    }
                });
            });
        });
    </script>

@endsection
