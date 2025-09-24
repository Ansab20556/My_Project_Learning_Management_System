@extends('theme.default')

@section('title', 'إضافة تخصص جديد')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">إضافة تخصص جديد</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.specializations.store') }}" method="POST">
                @csrf

                {{-- اسم التخصص --}}
                <div class="mb-3">
                    <label for="name" class="form-label">اسم التخصص</label>
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- الوصف --}}
                <div class="mb-3">
                    <label for="description" class="form-label">الوصف</label>
                    <textarea name="description" id="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ماذا ستتعلم --}}
                <div class="mb-3">
                    <label for="what_you_will_learn" class="form-label">ماذا ستتعلم</label>
                    <textarea name="what_you_will_learn" id="what_you_will_learn" rows="4"
                              class="form-control @error('what_you_will_learn') is-invalid @enderror">{{ old('what_you_will_learn') }}</textarea>
                    @error('what_you_will_learn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- زر الحفظ --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-success">حفظ التخصص</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
