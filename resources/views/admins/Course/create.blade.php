@extends('theme.default')

@section('title', 'إضافة كورس جديد')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">إضافة كورس جديد</h4>
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

            <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">عنوان الكورس</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">صورة الكورس</label>
                    <input type="file" name="cover_image" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">التخصص</label>
                    <select name="specialization" class="form-control" required>
                        <option value="">اختر التخصص</option>
                        @foreach($specializations as $specialization)
                            <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">المدربين</label>
                    <select name="teachers[]" class="form-control" multiple required>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">الوصف</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">عدد الساعات</label>
                    <input type="number" name="duration" class="form-control" value="{{ old('duration') }}">
                </div>

                <button type="submit" class="btn btn-success">حفظ الكورس</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">إلغاء</a>
            </form>

        </div>
    </div>
</div>
@endsection
