@extends('theme.default')

@section('title', 'تعديل الكورس')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">تعديل الكورس</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- عنوان الكورس --}}
                <div class="mb-3">
                    <label for="title" class="form-label">عنوان الكورس</label>
                    <input type="text" name="title" id="title" class="form-control"
                           value="{{ old('title', $course->title) }}" required>
                </div>

                {{-- صورة الكورس --}}
                <div class="mb-3">
                    <label for="cover_image" class="form-label">صورة الكورس</label>
                    <input type="file" name="cover_image" id="cover_image" class="form-control">
                    @if($course->cover_image)
                        <img src="{{ asset('storage/' . $course->cover_image) }}" alt="صورة الكورس" width="120" class="mt-2">
                    @endif
                </div>

                {{-- التخصص --}}
                <div class="mb-3">
                    <label for="specialization" class="form-label">التخصص</label>
                    <select name="specialization" id="specialization" class="form-control" required>
                        @foreach($specializations as $specialization)
                            <option value="{{ $specialization->id }}"
                                {{ $course->specialization_id == $specialization->id ? 'selected' : '' }}>
                                {{ $specialization->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- المدرب --}}
                <div class="mb-3">
                    <label for="teachers" class="form-label">المدربين</label>
                    <select name="teachers[]" id="teachers" class="form-control" multiple required>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ $course->teachers->contains($teacher->id) ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- الوصف --}}
                <div class="mb-3">
                    <label for="description" class="form-label">الوصف</label>
                    <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $course->description) }}</textarea>
                </div>

                {{-- المدة --}}
                <div class="mb-3">
                    <label for="duration" class="form-label">المدة (ساعات)</label>
                    <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration', $course->duration) }}">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">تحديث الكورس</button>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
