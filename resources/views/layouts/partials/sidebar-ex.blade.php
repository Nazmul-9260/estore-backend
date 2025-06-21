 <!-- sidebar start -->
 <nav class="pcoded-navbar">
     <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
     <div class="pcoded-inner-navbar main-menu">
         <div class="">
             <div class="main-menu-header">
                 <img class="img-80 img-radius" src="{{asset('assets/images/user-avatar.png')}}" alt="User-Profile-Image">
                 <div class="user-details">
                     <span id="more-details"> {{ Auth::user()->name }}</span>
                     <small class=" online-view">Online</small>
                     <!-- <small class="online-view offline-view">Online</small> -->
                 </div>
             </div>
         </div>
         <div class="p-15 p-b-0">
             <form class="form-material">
                 <div class="form-group form-primary">
                     <input type="text" name="footer-email" class="form-control">
                     <span class="form-bar"></span>
                     <label class="float-label"><i class="fa fa-search m-r-10"></i>Search</label>
                 </div>
             </form>
         </div>
         <ul class="pcoded-item pcoded-left-item">
             <li class="active">
                 <a href="{{url('/dashboard')}}" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                     <span class="pcoded-mtext">Dashboard</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
             </li>
         </ul>



         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu active pcoded-trigger"><!-- in module - add active & pcoded-trigger -->
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">User Management</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class="pcoded-hasmenu active pcoded-trigger"><!-- in submodule - add active & pcoded-trigger -->
                         <a href="javascript:void(0)" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                             <span class="pcoded-mtext">Users</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                         <ul class="pcoded-submenu">
                             <li class=" ">
                                 <a href="{{url('acl/users/create')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">Create User
                                     </span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                             <li class="active"><!-- in link li add active-->
                                 <a href="{{url('acl/users')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">Users</span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                             <span class="pcoded-mtext">Permissions</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                         <ul class="pcoded-submenu">
                             <li class=" ">
                                 <a href="{{url('acl/permissions/create')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">Create Permission
                                     </span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                             <li class=" ">
                                 <a href="{{url('acl/permissions')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">Permissions</span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     @if(auth()->user()->hasAnyPermission(['create-roles','view-roles']))
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                             <span class="pcoded-mtext">Roles</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                         <ul class="pcoded-submenu">
                             @if(auth()->user()->can('create-roles'))
                             <li class=" ">
                                 <a href="{{url('acl/roles/create')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">Create Role
                                     </span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                             @endif
                             @if(auth()->user()->can('view-roles'))
                             <li class=" ">
                                 <a href="{{url('acl/roles')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">Roles</span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                             @endif
                         </ul>
                     </li>
                     @endif
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                             <span class="pcoded-mtext">Modules</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                         <ul class="pcoded-submenu">
                             <li class=" ">
                                 <a href="{{url('acl/modules/create')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">Create Module
                                     </span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                             <li class=" ">
                                 <a href="{{url('acl/modules')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">Modules</span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                             <span class="pcoded-mtext">Submodules</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                         <ul class="pcoded-submenu">
                             <li class=" ">
                                 <a href="{{url('acl/submodules/create')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">Create Submodule
                                     </span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                             <li class=" ">
                                 <a href="{{url('acl/submodules')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">Submodules</span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Registration</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">New Registration</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Reg. Money Receive</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                             <span class="pcoded-mtext">New Dropdown</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                         <ul class="pcoded-submenu">
                             <li class=" ">
                                 <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">New Dropdown 1</span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                             <li class=" ">
                                 <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">New Dropdown 2</span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                         </ul>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Booth</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Registration</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">New Serial</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Serial for Special Day</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Special Day Serial Report</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Emergency</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Emergency Ticket</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Old Patient</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Emergency Ticket List</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Report</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Indoor</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Setup</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Admitted Patient Bill</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Admitted Patient Discount</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Outdoor</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Outdoor Ticket</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Outdoor Ticket List</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Old Patient</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Report</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Ticket</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Operation</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Setup</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Patient Operation</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Operation Payments</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Operation Schedule</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Diagnosis</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Diagnosis Test Reprint</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Report Doctor Commission</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Doctor</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Setup</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Ticket Patient List(Pending)</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Pharmacy</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Setup</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Medicine Discount</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>


         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Cafeteria</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Setup</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Food Requisition</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Ambulance</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Setup</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Ambulance Booking</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Report</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Store</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Setup</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Payment Permission</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Accounts</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Setup</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Voucher Entry</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Refund</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Approve Refund</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Refund Collection</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Employee</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Employee Create</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Report</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Report</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Transaction List</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Test wise Report
                             </span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Master</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class="pcoded-hasmenu">
                         <a href="javascript:void(0)" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                             <span class="pcoded-mtext">Initial</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                         <ul class="pcoded-submenu">
                             <li class=" ">
                                 <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">Employee Type
                                     </span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                             <li class=" ">
                                 <a href="{{url('/admin-sample-page')}}" class="waves-effect waves-dark">
                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                     <span class="pcoded-mtext">Employee Grade</span>
                                     <span class="pcoded-mcaret"></span>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     <li class=" ">
                         <a href="{{url('/admin-content-page')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Bank
                             </span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Contact Module</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/contact/contacts/create')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Create Contact</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/contact/contacts')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Contacts</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>




         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Theme Components</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class=" ">
                         <a href="{{url('/components')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Components</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/summer-note')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Summer Note</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/default-datatables')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Default Data Table</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class=" ">
                         <a href="{{url('/yajra-datatables')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Yajra Data Table</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>

                     <li class=" ">
                         <a href="{{url('/admin-module-settings')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Module Settings Page</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>

                     <li class=" ">
                         <a href="{{url('/admin-user-settings')}}" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">User Settings Page</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>


         <!-- <ul class="pcoded-item pcoded-left-item">
             <li class="">
                 <a href="chart-morris.html" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-bar-chart-alt"></i><b>C</b></span>
                     <span class="pcoded-mtext">Charts</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
             </li>
             <li class="">
                 <a href="map-google.html" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-map-alt"></i><b>M</b></span>
                     <span class="pcoded-mtext">Maps</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
             </li>
         </ul>
         <ul class="pcoded-item pcoded-left-item">
             <li class="pcoded-hasmenu ">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-id-badge"></i><b>A</b></span>
                     <span class="pcoded-mtext">Pages</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
                 <ul class="pcoded-submenu">
                     <li class="">
                         <a href="auth-normal-sign-in.html" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Login</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class="">
                         <a href="auth-sign-up.html" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                             <span class="pcoded-mtext">Registration</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                     <li class="">
                         <a href="sample-page.html" class="waves-effect waves-dark">
                             <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>S</b></span>
                             <span class="pcoded-mtext">Sample Page</span>
                             <span class="pcoded-mcaret"></span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul> -->
     </div>
 </nav>


 <!-- menu list

    
    Dashboard
    Registration
    - New Registration
    - Reg. Money Receive
    Booth
    - Registration
    - New Serial
    - Serial for Special Day
    - Special Day Serial Report
    Emergency
    - Emergency Ticket
    - Old Patient
    - Emergency Ticket List
    - Report
    Indoor
    - Setup
    - Admitted Patient Bill
    - Admitted Patient Discount
    Outdoor
    - Outdoor Ticket
    - Outdoor Ticket List
    - Old Patient
    - Report
    - Ticket
    Operation
    - Setup
    - Patient Operation
    - Operation Payments
    - Operation Schedule
    Diagnosis
    - Diagnosis Test Reprint
    - Report Doctor Commission
    Doctor
    - Setup
    - Ticket Patient List(Pending)
    Discount
    - Setup
    - Doctor Discount
    Pharmacy
    - Setup
    - Medicine Discount
    Cafeteria
    - Setup
    - Food Requisition
    Ambulance
    - Setup
    - Ambulance Booking
    - Report
    Store
    - Setup
    - Payment Permission
    Accounts
    - Setup
    - Voucher Entry
    Refund
    - Approve Refund
    - Refund Collection
    Employee
    - Employee Create
    - Report
    Report
    - Transaction List
    - Test wise Report
    Master
    - Initial
    - Employee Type
    - Employee Grade
    - Bank
    Settings
    - Users
    - Permissions
    - Roles -->