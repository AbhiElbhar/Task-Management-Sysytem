
<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{route('profile.show')}}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>
    
    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tools"></i>
                    <p>
                        Role And Permissions
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview"> 
                    <li class="nav-item">
                        <a href="{{route('user.index')}}" class="nav-link">
                            <i class="nav-icon"></i>
                            <p>Users</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('role.index')}}" class="nav-link">
                            <i class="nav-icon"></i>
                            <p>Role</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{route('permission.index')}}" class="nav-link">
                            <i class="nav-icon"></i>
                            <p>Permissions</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('users.activity')}}" class="nav-link">
                            <i class="nav-icon"></i>
                            <p>Activity Log</p>
                        </a>
                    </li>
                </ul>
            </li> 

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tools"></i>
                    <p>
                        user Tasks
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">                  
                    <li class="nav-item">
                        <a href="{{route('tasks.index')}}" class="nav-link">
                            <i class="nav-icon"></i>
                            <p>Task</p>
                        </a>
                    </li>
                    
                </ul>
            </li>
  
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all the links in the sidebar
        var links = document.querySelectorAll('.nav-link');
    
        // Loop through each link
        links.forEach(function(link) {
            // Add a click event listener to each link
            link.addEventListener('click', function() {
                // Remove the 'active' class from all links
                links.forEach(function(l) {
                    l.classList.remove('active');
                });
                // Add the 'active' class to the clicked link
                this.classList.add('active');
    
                // Store the id or any unique identifier of the clicked link in localStorage
                localStorage.setItem('activeLink', this.getAttribute('href'));
    
                // Remove 'active' class from all parent ul elements
                var parentULs = this.closest('.nav-treeview');
                if (parentULs) {
                    parentULs.parentNode.classList.add('menu-open');
                    parentULs.parentNode.querySelector('.fas.fa-angle-left.right').classList.add('rotate');
                }
            });
        });
    
        // Check if there's a stored active link in localStorage
        var storedActiveLink = localStorage.getItem('activeLink');
        if (storedActiveLink) {
            // Add the 'active' class to the link with the stored active state
            var activeLink = document.querySelector('.nav-link[href="' + storedActiveLink + '"]');
            if (activeLink) {
                activeLink.classList.add('active');
    
                // Add 'active' class to the parent ul element
                var parentUL = activeLink.closest('.nav-treeview');
                if (parentUL) {
                    parentUL.parentNode.classList.add('menu-open');
                    parentUL.parentNode.querySelector('.fas.fa-angle-left.right').classList.add('rotate');
                }
            }
        }
    });
    </script>
    