@extends('theme.default')

@section('title', 'عرض الوحدات')

@section('content')
<a class="btn btn-primary mb-3" href="{{ route('admin.modules.create') }}">
    <i class="fas fa-plus"></i> أضف وحدة جديدة
</a>

<div class="table-responsive">
    <table  id="modules-table"  class="table table-bordered text-right">
        <thead>
            <tr>
                <th>العنوان</th>
                <th>الوصف</th>
                <th>الكورس</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($modules as $module)
            <tr>
                <td>{{ $module->title }}</td>
                <td>{{ $module->description ?? '-' }}</td>
                <td>{{ $module->course->title ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.modules.edit', $module->id) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> تعديل
                    </a>
                    <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                            <i class="fas fa-trash"></i> حذف
                        </button>
                    </form>
                    <a href="{{ route('admin.modules.show', $module->id) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> عرض
                    </a>
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
    $('#modules-table').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
      }
    });
  });
</script>
@endsection
