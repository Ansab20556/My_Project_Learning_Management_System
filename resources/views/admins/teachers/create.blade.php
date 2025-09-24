@extends('theme.default')

@section('title', 'إضافة مدرّب جديد')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">إضافة مدرّب جديد</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">اسم المدرّب</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">السيرة</label>
                    <textarea name="bio" class="form-control" rows="4"></textarea>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">الصورة</label>
                    <input type="file" name="photo" class="form-control">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
