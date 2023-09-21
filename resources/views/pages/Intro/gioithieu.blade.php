@extends('welcome')
@section('content')

<div class="features_items">
    <h2 class="title text-center"><span style="color: #002795">LỊCH SỬ HÌNH THÀNH VÀ PHÁT TRIỂN</span> </h2>
        <h2 class="title text-center" style="margin: 0 150px">Hoài An Motor</h2>
    </div>
    @foreach ($intr as $key =>$int)
    <p style="margin-top: 20px">
       {!! $int->intro_desc !!}
    </p>
    @endforeach
@endsection