<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      
        <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link {{setMenuClass('home','active')}}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Accueil
              </p>
            </a>
        </li>
      
       @can('admin')
        
        <li class="nav-item {{setMenuClass('admin.management.','menu-open')}}">
            <a href="#" class="nav-link {{setMenuClass('admin.management.','active')}}">
              <i class=" nav-icon fas fa-user-shield"></i>
              <p>

                Gestion Itulisateurs
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{route('admin.management.shows_utilisateurs')}}" class="nav-link {{setMenuClass('admin.management.','active')}}">
                  <i class=" nav-icon fas fa-users-cog"></i>
                  <p>Utilisateurs</p>
                </a>
              </li>
            </ul>
        </li>
      @endcan

      @can('employe')
        <li class="nav-item ">
            <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                Gestion articles
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#"
                        class="nav-link ">
                    <i class="nav-icon far fa-circle"></i>
                    <p>Type d'articles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#"
                        class="nav-link ">
                    <i class="nav-icon fas fa-list-ul"></i>
                    <p>Articles</p>
                    </a>
                </li>
                
            </ul>
        </li>
      @endcan
        
  </ul>
</nav>