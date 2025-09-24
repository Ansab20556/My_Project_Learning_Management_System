@extends('theme.default')

@section('title', 'تفاصيل الكورس')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        {{ $course->title }}
    </div>
    <div class="card-body">
        <p><strong>التخصص:</strong> {{ $course->specialization->name ?? '-' }}</p>
        <p><strong>الوصف:</strong> {{ $course->description }}</p>
        <p><strong>المدربين:</strong>
            @foreach($course->teachers as $teacher)
                {{ $loop->first ? '' : '، ' }}{{ $teacher->name }}
            @endforeach
        </p>
        @if($course->cover_image)
            <p><strong>صورة الكورس:</strong></p>
            <img src="{{ asset('storage/' . $course->cover_image) }}" alt="صورة الكورس" width="200">
        @endif
    </div>
</div>
@endsection
