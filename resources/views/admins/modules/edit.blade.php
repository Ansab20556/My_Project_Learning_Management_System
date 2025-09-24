@extends('theme.default')

@section('title', 'تعديل الوحدة')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">تعديل الوحدة</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.modules.update', $module->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="mb-3">
                    <label for="title" class="form-label">عنوان الوحدة</label>
                    <input type="text" name="title" id="title" class="form-control"
                           value="{{ old('title', $module->title) }}" required>
                </div>



                {{-- التخصص --}}
                <div class="mb-3">
                    <label for="course_id" class="form-label">الكورس</label>
                    <select name="course_id" id="course_id" class="form-control" required>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ $module->course->id === $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- الوصف --}}
                <div class="mb-3">
                    <label for="description" class="form-label">الوصف</label>
                    <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $course->description) }}</textarea>
                </div>



                <div class="text-end">
                    <button type="submit" class="btn btn-success">تحديث الوحدة</button>
                    <a href="{{ route('admin.modules.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection