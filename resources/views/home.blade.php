@extends('layouts.app')


{{--


    พวก view มึงสร้างโฟลเดอร์มาแยก ในแต่ละหน้าได้
    อย่างเช่นหมวดหมู่ blog ก็สร้างโฟลเดอร์ blog แล้วข้างใดก็มีหน้า show, edit, delete อะไรก็แล้วไป
    เวลาโยงก็ ใช้ . แทน / เช่น

    view('blog.edit');
    --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/create">create</a>
                    <a href="/blog">all products</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
