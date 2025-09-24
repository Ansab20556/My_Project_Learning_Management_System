@extends('theme.default')

@section('title', 'إضافة درس جديد')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">إضافة درس جديد</h4>
        </div>
        <div class="card-body">
            {{-- عرض الأخطاء --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- الفورم --}}
            <form action="{{ route('admin.Lessons.store') }}" method="POST">
                @csrf

                <!-- عنوان الدرس -->
                <div class="mb-3">
                    <label for="title" class="form-label">عنوان الدرس</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>

                <!-- وصف الدرس -->
                <div class="mb-3">
                    <label for="description" class="form-label">الوصف</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>

                <!-- رابط الفيديو -->
                <div class="mb-3">
                    <label for="video_url" class="form-label">رابط الفيديو</label>
                    <input type="url" name="video_url" id="video_url" class="form-control" value="{{ old('video_url') }}">
                </div>

                <!-- مدة الدرس -->
                <div class="mb-3">
                    <label for="duration" class="form-label">المدة (بالدقائق)</label>
                    <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration') }}">
                </div>

                <!-- الوحدة -->
                <div class="mb-3">
                    <label for="module_id" class="form-label">الوحدة</label>
                    <select name="module_id" id="module_id" class="form-control" required>
                        <option value="">اختر الوحدة</option>
                        @foreach($modules as $module)
                            <option value="{{ $module->id }}" {{ old('module_id') == $module->id ? 'selected' : '' }}>
                                {{ $module->title }} ({{ $module->course->title ?? 'بدون كورس' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">حفظ الدرس</button>
                <a href="{{ route('admin.Lessons.index') }}" class="btn btn-secondary">إلغاء</a>
            </form>

        </div>
    </div>
</div>
@endsection