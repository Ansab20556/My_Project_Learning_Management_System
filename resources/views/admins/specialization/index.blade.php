@extends('theme.default')

@section('heading')
    عرض التخصصات
@endsection

@section('content')
    <a class="btn btn-primary" href="{{ route('admin.specializations.create') }}">
        <i class="fas fa-plus"></i> أضف تخصصًا جديدًا
    </a>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table id="specializations-table" class="table table-striped table-bordered text-right" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>الوصف</th>
                        <th>ماذا ستتعلم</th>
                        <th>خيارات</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($specializations as $specialization)
                        <tr>
                            <td>
                                <a href="{{route('admin.specializations.show' ,$specialization->id)}}">
                                    {{ $specialization->name }}
                                </a>
                            </td>
                            <td>{{ Str::limit($specialization->description, 50, '...') }}</td>
                            <td>{{ Str::limit($specialization->what_you_will_learn, 50, '...') }}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{route('admin.specializations.edit' ,$specialization->id)}}">
                                    <i class="fa fa-edit"></i> تعديل
                                </a>
                                <form method="POST" action="{{route('admin.specializations.destroy' ,$specialization->id)}}" class="d-inline-block">
                                    @method('delete')
                                    @csrf
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
    </div>
@endsection


@section('script')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function () {
    $('#specializations-table').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
      }
    });
  });
</script>
@endsection