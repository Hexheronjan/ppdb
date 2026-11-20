<!-- ---------------------------------- -->
<!-- Start Vertical Layout Sidebar -->
<!-- ---------------------------------- -->
<div class="p-5 flex items-center justify-between" >
  @include("layouts.admin.partial.logo-sidebar")
  <button type="button" class="lg:hidden text-gray-500 hover:text-gray-700 p-1.5 rounded-lg focus:outline-none" data-hs-overlay="#application-sidebar-brand" aria-label="Close sidebar">
    <i class="ti ti-x text-2xl"></i>
  </button>
</div>
<div class="scroll-sidebar" data-simplebar="">
 <div class="px-6 mt-8" >
    <nav class=" w-full flex flex-col sidebar-nav">
      <ul  id="sidebarnav" class="text-gray-600 text-sm">
        <li class="text-xs font-bold pb-4">
          <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
          <span>HOME</span>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link gap-3 py-2 px-3  rounded-md  w-full flex items-center hover:text-blue-600 hover:bg-blue-500" href="{{ route('admin.dashboard')}}"
           >
            <i class="ti ti-layout-dashboard  text-xl"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class="text-xs font-bold mb-4 mt-8">
          <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
          <span>MASTER DATA</span>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500" href="{{ route('admin.schools.index')}}"
           >
            <i class="ti ti-school  text-xl"></i> <span>Data Sekolah</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500" href="{{ route('admin.angkatan.index')}}"
           >
            <i class="ti ti-calendar-event  text-xl"></i> <span>Data Angkatan</span>
          </a>
        </li>

        <li class="text-xs font-bold mb-4 mt-8">
          <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
          <span>KELOLA DATA</span>
        </li>



        <li class="sidebar-item">
          <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500" href="{{ route('admin.santri.index')}}"
           >
            <i class="ti ti-users  text-xl"></i> <span>Data Santri Baru</span>
          </a>
        </li> 

        <li class="sidebar-item">
          <a class="sidebar-link gap-3 py-2 px-3 rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500" href="{{ route('admin.otp.index')}}"
           >
            <i class="ti ti-key text-xl"></i> <span>Monitoring OTP</span>
          </a>
        </li> 



        <li class="sidebar-item">
          <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500" href="{{ route('admin.profile.edit')}}"
           >
            <i class="ti ti-file-description  text-xl"></i> <span>Profil</span>
          </a>
        </li> 

        {{-- <li class="sidebar-item">
          <a class="sidebar-link gap-3 py-2 px-3  rounded-md w-full flex items-center hover:text-blue-600 hover:bg-blue-500" href="@@webRoot/pages/authentication-register.html"
           >
            <i class="ti ti-user-plus  text-xl"></i> <span>Register</span>
          </a>
        </li>   --}}

        <li class="text-xs font-bold mb-4 mt-8">
          <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
          <span>---------------------------</span>
        </li>

        <li class="sidebar-item">
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="sidebar-link gap-3 py-2 px-3 rounded-md w-full flex items-center text-left hover:text-red-600 hover:bg-red-100">
                  <i class="ti ti-logout text-xl"></i>
                  <span>Logout</span>
              </button>
          </form>
      </li>
      

      </ul>
    </nav>
  </div>
</div>

<!-- </aside> -->