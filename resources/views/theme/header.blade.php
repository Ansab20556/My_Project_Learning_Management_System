<header id="header" class="header dark-background d-flex flex-column">
    <i class="header-toggle d-xl-none bi bi-list"></i>

    <div class="profile-img">
      <img src="{{asset('theme/img/my-profile-img.jpg') }}" alt="" class="w-18 h-45 object-cover rounded-full border-2 border-white rounded-circle">
    </div>

    <a href="index.html" class="logo d-flex align-items-center justify-content-center">
      <!-- Uncomment the line below if you also wish to use an image logo -->
      <!-- <img src="assets/img/logo.png" alt=""> -->
      <h1 class="sitename">أدمن</h1>
    </a>

    <div class="social-links text-center">
      <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
      <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
      <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
      <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
      <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
    </div>

    <nav id="navmenu" class="navmenu">
  <ul>
    {{-- المدير العام (Super Admin) --}}
    @can('update-users')
    <li><a href="{{ route('admin.users.index') }}">
        <i class="bi bi-people navicon"></i> المستخدمين
      </a></li>
    <li><a href="{{route('admin.teachers.index')}}">
        <i class="bi bi-hdd-stack navicon"></i> المدربين
      </a></li>

      <li><a href="{{route('admin.specializations.index')}}" class="active">
        <i class="bi bi-house navicon"></i> التخصصات
      </a></li>
      <li><a href="{{route('admin.courses.index')}}">
        <i class="bi bi-person navicon"></i> الكورسات
      </a></li>
      <li><a href="{{route('admin.modules.index')}}">
        <i class="bi bi-file-earmark-text navicon"></i> الوحدات
      </a></li>
      <li><a href="#portfolio">
        <i class="bi bi-images navicon"></i> الدروس
      </a></li>

      <li>
    <a href="{{ route('admin.assignments.index') }}">
        <i class="bi bi-pencil-square navicon"></i> Assignments
    </a>
</li>

      <li><a href="#">
        <i class="bi bi-upload navicon"></i> Submissions
      </a></li>


    @endcan

    {{-- المدرس (Teacher) --}}
    @can('access-admin')
    <li><a href="{{ route('teacher.courses.my') }}">
    <i class="bi bi-journal-text navicon"></i> My Courses
    </a></li>

      <li><a href="{{ route('teacher.courses.create') }}">
        <i class="bi bi-plus-circle navicon"></i> Add New Course
      </a></li>
      <li><a href="#">
        <i class="bi bi-book navicon"></i> Lessons
      </a></li>
      <li><a href="{{route('teacher.assignments.my')}}">
        <i class="bi bi-pencil-square navicon"></i>  my Assignments
      </a></li>



      <li><a href="#">
        <i class="bi bi-upload navicon"></i> Submissions
      </a></li>
    @endcan
  </ul>
</nav>


  </header>
