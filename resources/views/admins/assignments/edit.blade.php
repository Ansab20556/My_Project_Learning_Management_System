{{-- resources/views/admins/assignments/edit.blade.php --}}
@extends('theme.default')

@section('title', 'تعديل التكليف')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">تعديل التكليف</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.assignments.update', $assignment->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- عنوان التكليف --}}
                <div class="mb-3">
                    <label for="title" class="form-label">عنوان التكليف</label>
                    <input type="text" name="title" id="title" class="form-control"
                           value="{{ old('title', $assignment->title) }}" required>
                </div>

                {{-- الكورس --}}
                <div class="mb-3">
                    <label for="course_id" class="form-label">الكورس</label>
                    <select name="course_id" id="course_id" class="form-control" required>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ $assignment->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- الوصف --}}
                <div class="mb-3">
                    <label for="description" class="form-label">الوصف</label>
                    <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $assignment->description) }}</textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">تحديث التكليف</button>
                    <a href="{{ route('admin.assignments.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
