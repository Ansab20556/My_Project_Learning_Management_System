@extends('theme.default')

@section('title', 'تفاصيل المدرّب')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        {{ $teacher->name }}
    </div>
    <div class="card-body">
        <p><strong>السيرة الذاتية:</strong> {{ $teacher->bio }}</p>
        @if($teacher->photo)
            <p><strong>الصورة:</strong></p>
            <img src="{{ asset('storage/' . $teacher->photo) }}" alt="صورة المدرّب" width="200">
        @endif
    </div>
</div>
@endsection