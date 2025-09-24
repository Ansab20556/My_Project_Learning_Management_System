@extends('theme.default')

@section('title', 'عرض الوحدة')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">تفاصيل الوحدة</h4>
        </div>
        <div class="card-body">
            <p><strong>عنوان الوحدة:</strong> {{ $module->title }}</p>
            <p><strong>الوصف:</strong> {{ $module->description ?? 'لا يوجد وصف' }}</p>
            <p><strong>الكورس:</strong> {{ $module->course ? $module->course->title : 'غير مرتبط' }}</p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.modules.index') }}" class="btn btn-secondary">رجوع للقائمة</a>
            <a href="{{ route('admin.modules.edit', $module->id) }}" class="btn btn-warning">تعديل</a>
            
            <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الوحدة؟')" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">حذف</button>
            </form>
        </div>
    </div>
</div>
@endsection
