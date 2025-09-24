{{-- resources/views/admins/assignments/show.blade.php --}}
@extends('theme.default')

@section('title', 'تفاصيل التكليف')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        {{ $assignment->title }}
    </div>
    <div class="card-body">
        <p><strong>الكورس:</strong> {{ $assignment->course->title ?? '-' }}</p>
        <p><strong>الوصف:</strong> {{ $assignment->description ?? '-' }}</p>
    </div>
</div>
@endsection
