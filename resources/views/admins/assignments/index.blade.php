{{-- resources/views/admins/assignments/index.blade.php --}}
@extends('theme.default')

@section('title', 'عرض التكاليف')

@section('content')
<a class="btn btn-primary mb-3" href="{{ route('admin.assignments.create') }}">
    <i class="fas fa-plus"></i> أضف تكليف جديد
</a>

<div class="table-responsive">
    <table id="assignments-table" class="table table-bordered text-right">
        <thead>
            <tr>
                <th>العنوان</th>
                <th>الكورس</th>
                <th>الوصف</th>
                <th>خيارات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assignments as $assignment)
            <tr>
                <td><a href="{{ route('admin.assignments.show', $assignment->id) }}">{{ $assignment->title }}</a></td>
                <td>{{ $assignment->course->title ?? '-' }}</td>
                <td>{{ $assignment->description }}</td>
                <td>
                    <a href="{{ route('admin.assignments.edit', $assignment->id) }}" class="btn btn-info btn-sm">
                        <i class="fa fa-edit"></i> تعديل
                    </a>
                    <form action="{{ route('admin.assignments.destroy', $assignment->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                            <i class="fa fa-trash"></i> حذف
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function () {
    $('#assignments-table').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
      }
    });
  });
</script>
@endsection
