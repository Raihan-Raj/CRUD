   <!-- ========== Left Sidebar Start ========== -->
   <div class="vertical-menu">
       <div data-simplebar class="h-100">
           <!--- Sidemenu -->
           <div id="sidebar-menu">
               <!-- Left Menu Start -->
               <ul class="metismenu list-unstyled" id="side-menu">
                   <li class="menu-title" key="t-menu"> <span
                           class="font-weight-bolder text-uppercase"><mark>Dashboard</mark></span></li>

                   @if (Auth::user()->typ == 1)
                       {{--  <li>
                           <a href="javascript: void(0);" class="waves-effect has-arrow">
                               <i class="bx bx-home-circle"></i><span
                                   class="badge rounded-pill bg-info float-end">04</span>
                               <span key="t-dashboards">Admin Section</span>
                           </a>
                           <ul class="sub-menu" aria-expanded="false">
                               <li>
                                   <a href="#" key="t-default"><i class="far fa-circle nav-icon"></i>
                                       <span> Admin Section</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="" key="t-default"><i class="fas fa-list"></i>
                                       <span> Admin List</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="" key="t-default"><i class="fas fa-edit"></i>
                                       <span>Create Admin</span>
                                   </a>
                               </li>
                           </ul>
                       </li> --}}
                   @endif

                   <li class="menu-title" key="t-apps">Apps</li>
                   <li>
                       <a href="javascript: void(0);" class="waves-effect has-arrow">
                           <i class="fab fa-bandcamp"></i><span class="badge rounded-pill bg-success float-end"></span>
                           <span key="t-dashboards">Authors</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li>
                               <a href="{{ route('authors') }}" key="t-default">
                                   <i class="fas fa-list"></i> <span>Authors Section</span>
                               </a>
                           </li>
                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="waves-effect has-arrow">
                           <i class="fab fa-bandcamp"></i><span class="badge rounded-pill bg-success float-end"></span>
                           <span key="t-dashboards">Book</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li>
                               <a href="{{ route('books') }}" key="t-default">
                                   <i class="fas fa-list"></i> <span>Book List</span>
                               </a>
                           </li>
                           <li>
                               <a href="{{ route('book.create') }}" key="t-default">
                                   <i class="fas fa-pen"></i>
                                   <span>Add Book</span>
                               </a>
                           </li>

                       </ul>
                   </li>

                   <li>
                       <a href="javascript: void(0);" class="waves-effect has-arrow">
                           <i class="fas fa-store"></i><span class="badge rounded-pill bg-success float-end"></span>
                           <span key="t-dashboards">Category</span>
                       </a>
                       <ul class="sub-menu" aria-expanded="false">
                           <li>
                               <a href="{{ route('categories') }}" key="t-default">
                                   <i class="fas fa-list"></i> <span>Category List</span>
                               </a>
                           </li>
                           <li>
                               <a href="{{ route('categories.create') }}" key="t-default">
                                   <i class="fas fa-pen"></i>
                                   <span> Add category</span>
                               </a>
                           </li>
                       </ul>
                   </li>
               </ul>
           </div>
           <!-- Sidebar -->
       </div>
   </div>
   <!-- Left Sidebar End -->
