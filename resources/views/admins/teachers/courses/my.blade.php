@extends('theme.default')

@section('title', ' عرض كورساتي ')

@section('content')
<a class="btn btn-primary mb-3" href="{{ route('teacher.courses.create') }}">
    <i class="fas fa-plus"></i> أضف كورس جديد
</a>

<div class="table-responsive">
    <table    id="courses-table" class="table table-bordered text-right">
        <thead>
            <tr>
                <th>العنوان</th>
                <th>التخصص</th>
                <th>الوصف</th>
                <th>المدربين</th>
                <th>اضافة واجب</th>
                <th>خيارات</th>
            </tr>
        </thead>
        <tbody>
        @forelse($courses as $course)
            <tr>
                <td><a href="{{route('teacher.courses.show' ,$course->id)}}">{{ $course->title }}</a></td>
                <td>{{ $course->specialization->name ?? '-' }}</td>
                <td>{{ $course->description }}</td>
                <td>
                   @if($course->teachers && $course->teachers->count())
                     @foreach($course->teachers as $teacher)
                     {{ $loop->first ? '' : '، ' }}{{ $teacher->name }}
                      @endforeach
                       @else
                        -
                     @endif
                    </td>

                    <td>
                   
        <a href="{{ route('teacher.assignments.create', $course->id) }}">
        <i class="bi bi-pencil-square navicon"></i> add new Assignments
        </a>
        

                    </td>
                <td>
                    <a href="{{ route('teacher.courses.edit', $course->id) }}" class="btn btn-info btn-sm">
                        <i class="fa fa-edit"></i> تعديل
                    </a>

                    
                    <form action="{{ route('teacher.courses.destroy', $course->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                            <i class="fa fa-trash"></i> حذف
                        </button>
                    </form>
                </td>
            </tr>

            @empty
                <tr>
                    <td colspan="5">لا يوجد كورسات خاصة بك بعد.</td>
                </tr>
         @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function () {
    $('#courses-table').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json"
      }
    });
  });
</script>
@endsection