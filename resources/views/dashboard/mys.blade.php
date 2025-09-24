@extends('layouts.main')

@section('title', 'تكاليفي')

@section('content')
<div class="container py-4">
  <h3 class="mb-4 text-center">التكاليف الخاصة بي</h3>

  <div class="row g-4">
    @forelse($assignments as $assignment)
      <div class="col-md-6">
        <div class="card shadow-sm h-100">
          <div class="card-header bg-primary text-white">
            {{ $assignment->title }}
          </div>
          <div class="card-body">
            <p><strong>الكورس:</strong> {{ $assignment->course->title }}</p>
            <p>{{ Str::limit($assignment->description, 150) }}</p>

            {{-- لو الطالب سبق وسلّم ملف --}}
            @if($assignment->pivot->file_path ?? false)
              <p><strong>ملف التسليم:</strong> 
                <a href="{{ asset('storage/' . $assignment->pivot->file_path) }}" target="_blank">عرض الملف</a>
              </p>
            @endif

            {{-- زر رفع ملف --}}
            <form action="{{ route('assignments.submit', $assignment->id) }}" 
      method="POST" 
      enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept="image/*" required>
    <button type="submit" class="btn btn-primary">رفع الصورة</button>
</form>

          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info text-center">
          لا توجد تكاليف حالياً
        </div>
      </div>
    @endforelse
  </div>
</div>
@endsection
