<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    @if(Auth::user()->avatar)
                        <img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image" />
                    
                    @else
                        <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                    @endif
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    
                </div>
            </div>
        @endif

        

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header"></li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ url('/destino') }}"><i class='fa '></i> <span>Reservar bus</span></a></li>
            <li><a href="#"><i class='fa '></i> <span>Mis reservas</span></a></li>
            <li><a href="#"><i class='fa '></i> <span>Rutas</span></a></li>
            <li><a href="#"><i class='fa '></i> <span>Administrar</span></a></li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
