@extends('theme.default')

@section('title', 'عرض الدرس')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $lesson->title }}</h4>
        </div>
        <div class="card-body">
            <p><strong>الوحدة:</strong> {{ $lesson->module->title ?? '-' }}</p>
            <p><strong>الكورس:</strong> {{ $lesson->module->course->title ?? '-' }}</p>
            <p><strong>الوصف:</strong> {{ $lesson->description ?? '-' }}</p>
            <p><strong>المدة:</strong> {{ $lesson->duration ?? '-' }} دقيقة</p>

            <p><strong>الفيديو:</strong></p>
            @if($lesson->video_url)
                <a href="{{ asset('storage/' . $lesson->video_url) }}" target="_blank">
                    مشاهدة الفيديو
                </a>
                <br><br>
                <!-- مشغل الفيديو المدمج -->
                <video width="100%" controls>
                    <source src="{{ asset('storage/' . $lesson->video_url) }}" type="video/mp4">
                    متصفحك لا يدعم عرض الفيديو.
                </video>
            @else
                <span>-</span>
            @endif
        </div>
    </div>
</div>
@endsection