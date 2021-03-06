<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        
        <!-- END Side Header -->
        
        <!-- Side User -->
        <div class="content-side content-side-full px-10 align-parent">
            <!-- Visible only in mini mode -->
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                    <a class="img-link" href="javascript:void(0)">
                    <img class="img-avatar" src="{{ asset('media/avatars/avatar0.jpg') }}" alt="">
                </a>
                        
                    </li>
                    <li class="list-inline-item">
                    <a class="link-effect text-dual-primary-dark font-size-sm font-w600 text-uppercase">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="link-effect text-dual-primary-dark"><i class="si si-logout"></i></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a href="{{ route('home') }}"><span class="sidebar-mini-hide">Home</span></a>
                </li>
                <li>
                <a href="{{ route('locations.view') }}"><span class="sidebar-mini-hide">Locations</span></a>
                <a href="{{ route('images.view') }}"><span class="sidebar-mini-hide">Images</span></a>
                
                </li>
                <!--  -->
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>

