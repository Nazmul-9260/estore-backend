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
                 <a href="{{url('/dashboard')}}" class="waves-effect waves-dark menu-link" id="dashboard">
                     <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                     <span class="pcoded-mtext">Dashboard</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="">
                 <a href="#" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Report</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
             </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
             <li class="">
                 <a href="#" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Profile</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
             </li>
         </ul>
         <ul class="pcoded-item pcoded-left-item">
             <li class="">
                 <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i><b>BC</b></span>
                     <span class="pcoded-mtext">Logout</span>
                     <span class="pcoded-mcaret"></span>
                 </a>
             </li>
         </ul>
     </div>
 </nav>
