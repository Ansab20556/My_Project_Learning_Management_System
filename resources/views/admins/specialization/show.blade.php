@extends('theme.default')

@section('title', 'تفاصيل التخصص')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">
        {{ $specialization->name }}
    </div>
    <div class="card-body">
        <p><strong>الوصف:</strong> {{ $specialization->description }}</p>
        <p><strong>ماذا ستتعلم:</strong> {{ $specialization->what_you_will_learn }}</p>
    </div>
</div>
@endsection