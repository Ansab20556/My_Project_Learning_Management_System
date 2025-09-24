@extends('theme.default')

@section('title', 'قائمة المدرّبين')

@section('content')
    <a class="btn btn-primary" href="{{ route('admin.users.index') }}"><i class="fas fa-plus"></i> أضف مدرّبًا جديدًا</a>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table id="teachers-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>السيرة</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                        <tr>
                            <td>
                                @if($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" width="60" class="rounded">
                                @else
                                    لا يوجد
                                @endif
                            </td>
                            <td><a href="{{route('admin.teachers.show' ,$teacher->id)}}">{{ $teacher->name }}</a></td>
                            <td>{{ Str::limit($teacher->bio, 50) }}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('admin.teachers.edit', $teacher->id) }}">
                                    <i class="fa fa-edit"></i> تعديل
                                </a>
                                <form method="POST" action="{{ route('admin.teachers.destroy', $teacher->id) }}" class="d-inline-block">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">
                                        <i class="fa fa-trash"></i> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function () {
    $('#teachers-table').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
      }
    });
  });
</script>
@endsection
