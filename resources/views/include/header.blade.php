<header>
        <div class="container-fluid bg-secondary">
            <div class="row">
                <div class="col d-flex align-items-center justify-content-center">
                    <div class="p-4"><img src="{{ '../storage/img/logo.png' }}" width="100px" height="100px"/></div>
                    @guest
                        <div class="p-4 titulo text-light"><a class="titulo text-light" href="/">SERVICE DESK - Gestor Incidencias</a>
                        </div>
                    @else
                        <div class="p-4 titulo text-light"><a class="titulo text-light" href="/">SERVICE DESK - {{Auth::user()->nombre}}</a>
                        </div>
                    @endguest
                </div>
                <div class="col d-flex align-items-end justify-content-center"> 
                  @guest
                    <div class="p-2"><button type="button" class="btn btn-link"><a href="{{route('login')}}" 
                        class="text-light fs-6">Acceso <i class="fas fa-sign-in-alt"></i></a></button>
                    </div>
                    
                    <div class="p-2"><button type="button" class="btn btn-link"><a href="{{route('register')}}"
                        class="text-light fs-6">Registro <i class="fas fa-user-plus"></i></a></button>
                    </div>   
                  @else
                    <div class="p-2 dropdown">
                        <button type="button" class="btn btn-link text-light fs-6" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Incidencias</button>
                        
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item fs-6" href="/incidencias">Mis incidencias</a>
                            <a class="dropdown-item fs-6" href="/incidencia_buscar">Buscar</a>
                            <a class="dropdown-item fs-6" href="/incidencia_add">Añadir</a>
                        </div>
                    </div>
                    <div class="p-2 dropdown">
                        <button type="button" class="btn btn-link text-light fs-6" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mensajeria</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item fs-6" href="#">Añadir</a>
                        </div>
                    </div>
                    @if (\Auth::user()->perfil == 'admin')
                       <div class="p-2"><Button type="button" class="btn btn-link">
                        <a href="/usuarios" class="text-light fs-6">Usuarios</a></div>
                       <div class="p-2"><Button type="button" class="btn btn-link">
                        <a href="/logs" class="text-light fs-6">Logs</a></div>
                    @endif
                    <div class="p-2"><button type="button" class="btn btn-link"><a href="{{route('logout')}}" 
                        class="text-light fs-6">Logout <i class="fas fa-sign-in-alt"></i></a></button>
                    </div>
                  @endguest
                </div>              
            </div>
        </div>
</header>