 <!-- START SIDEBAR-->
 <nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ url('/')}}/admin_assets/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{Session::get('user')}}</div><small>Administrator</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{url('/')}}/admin/dashboard"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Masters</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('/')}}/admin/volume">Volume</a>
                    </li>

                    <li>
                        <a href="{{url('/')}}/admin/issue">Issue</a>
                    </li>
                   
                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Pages</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{url('/')}}/admin/pages">Manage Pages</a>
                    </li>
                   
                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">Articles</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                      <a href="{{url('/')}}/admin/articles">Manage Articles</a>
                    </li>
                   
                </ul>
            </li>

           
            <li>
               <a href="{{url('admin/manage-menus')}}"><i class="sidebar-item-icon fa fa-bookmark"></i> Menu</a>
                    
            </li>

            <li>
               <a href="{{url('admin/widget')}}"><i class="sidebar-item-icon fa fa-bookmark"></i> Widgets</a>
                    
            </li>

            <li>
               <a href="{{url('admin/setting/edit/1')}}"><i class="sidebar-item-icon fa fa-bookmark"></i> Setting</a>
                    
            </li>
          
          
        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->
<div class="content-wrapper">
