@extends('theme.default')

@section('title', 'تعديل المدرب')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">تعديل المدرب</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- اسم المدرب --}}
                <div class="mb-3">
                    <label for="name" class="form-label">اسم المدرب</label>
                    <input type="text" name="name" id="name" class="form-control"
                           value="{{ old('name', $teacher->name) }}" required>
                </div>

                {{-- السيرة الذاتية --}}
                <div class="mb-3">
                    <label for="bio" class="form-label">السيرة الذاتية</label>
                    <textarea name="bio" id="bio" rows="4" class="form-control">{{ old('bio', $teacher->bio) }}</textarea>
                </div>

                {{-- صورة المدرب --}}
                <div class="mb-3">
                    <label for="photo" class="form-label">صورة المدرب</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                    @if($teacher->photo)
                        <img src="{{ asset('storage/' . $teacher->photo) }}" alt="صورة المدرب" width="120" class="mt-2">
                    @endif
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">تحديث المدرب</button>
                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection