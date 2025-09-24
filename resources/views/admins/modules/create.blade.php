@extends('theme.default')

@section('title', 'إضافة وحدة  جديد')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">إضافة وحدة جديد</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.modules.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">عنوان الوحدة</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>


                <div class="mb-3">
                    <label class="form-label"> الكورس</label>
                    <select name="course_id" class="form-control" multiple required>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="mb-3">
                    <label class="form-label">الوصف</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>



                <button type="submit" class="btn btn-success">حفظ الوحدة</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">إلغاء</a>
            </form>

        </div>
    </div>
</div>
@endsection