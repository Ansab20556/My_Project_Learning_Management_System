@extends('layouts.main')

@section('content')
<div class="container py-4">
  <h3 class="mb-4 text-center">جميع الكورسات</h3>

  <div class="row g-4">
    @forelse($courses as $course)
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          {{-- صورة الكورس --}}
          @if($course->cover_image)
            <img 
              src="{{ asset('storage/' . $course->cover_image) }}" 
              class="card-img-top" 
              alt="{{ $course->title }}" 
              style="height:220px; object-fit:cover;">
          @else
            <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                 style="height:220px;">
              لا توجد صورة
            </div>
          @endif

          {{-- تفاصيل الكورس --}}
          <div class="card-body d-flex flex-column">
            <h5 class="card-title mb-2">{{ $course->title }}</h5>

            <p class="mb-1">
              <small class="text-muted">
                {{ $course->specialization->name ?? 'عام' }}
              </small>
            </p>

            <p class="card-text text-muted flex-grow-1">
              {{ Str::limit($course->description, 100) }}
            </p>

            {{-- الأزرار --}}
            <div class="mt-3 d-flex gap-2">
              <a href="#" 
                 class="btn btn-outline-primary btn-sm flex-grow-1">
                عرض التفاصيل
              </a>

              @auth
                @if(auth()->user()->administration_level === 0)
                  <form action="{{ route('courses.register', $course->id) }}" 
                        method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">سجل الآن</button>
                  </form>
                @endif
              @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                  سجل الدخول
                </a>
              @endauth
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info text-center">
          لا يوجد كورسات حالياً
        </div>
      </div>
    @endforelse
  </div>

  {{-- لو عندك pagination --}}
  <div class="mt-4">
    {{ $courses->links() }}
  </div>
</div>
@endsection


