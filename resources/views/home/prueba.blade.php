<x-layauts.appPerfil>
  
  <div class="container-fluid">
  @auth
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Menu</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link align-middle px-0">
                            <i class="fas fa-home"></i> <span class="ms-1 d-none d-sm-inline">Inicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('cart.store')}}" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fas fa-shopping-cart"></i> <span class="ms-1 d-none d-sm-inline">Compras</span> </a>
                    </li>
                    <li>
                        <a href="{{route('menu')}}" class="nav-link px-0 align-middle">
                            <i class="fas fa-hamburger"></i> <span class="ms-1 d-none d-sm-inline">Menu</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('productos')}}" class="nav-link align-middle px-0">
                            <i  class="fas fa-shopping-bag"></i> <span class="ms-1 d-none d-sm-inline">Productos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('recetas')}}" class="nav-link px-0 align-middle">
                            <i class="fas fa-utensils"></i> <span class="ms-1 d-none d-sm-inline">Recetas</span> </a>
                    </li>
                    <li>
                        <a href="{{route('opiniones')}}" class="nav-link px-0 align-middle">
                            <i class="fas fa-comment"></i> <span class="ms-1 d-none d-sm-inline">Comentarios</span> </a>
                    </li>
                    <li>
                        <a href="{{route('contactos')}}" class="nav-link px-0 align-middle">
                            <i class="fas fa-envelope"></i> <span class="ms-1 d-none d-sm-inline">Contactanos</span> </a>
                    </li>
                    <li>
                        <a href="{{route('nosotros')}}" class="nav-link px-0 align-middle">
                            <i class="fas fa-users"></i> <span class="ms-1 d-none d-sm-inline">Sobre nosotros</span> </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->avatar }}" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">{{ Auth::user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                        <form action="/logout" class="d-flex mr-1" method="post">
                @csrf

                <a class="dropdown-item" href="#" onclick="this.closest('form').submit()">cerrar session</a>
              </form>  
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">
        <section class="caja  justify-content-center " style="  margin-bottom: 50px; width: 100%;">

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center ">
            <img src="{{ Auth::user()->avatar }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
           
            <h5 class="my-3">{{ Auth::user()->username }}</h5>
            <p class="text-muted mb-1">{{ Auth::user()->email }}</p>


            <div class="d-flex justify-content-center mb-2">

              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Subir productos
              </button>

              <!-- Modal -->
              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group">
                          <label for="name">
                            Nombre
                          </label>
                          <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label for="price">
                            Precio
                          </label>
                          <input type="number" name="price" id="price" class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label for="image">
                            Imagen
                          </label>
                          <input type="file" name="image" id="image" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">enviar</button>
                    </div>
                  </div>
                  </form>
                </div>
              </div>




              <!-- Button para subir recetas  -->
              <button type="button" class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                publicar recetas
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                      @if(Auth::check())
                      <form   action="{{ route('crudRecetas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                        <label for="">
                          nombre de receta
                        </label>
                        <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                        <label for="">
                          imagen
                        </label>
                        <input type="file" class="form-control" name="images"  accept="image/*">
                        </div>

                        <div class="form-group">
                        <label for="">
                          preparacion
                        </label>
                        <input name="ingredients" class="form-control" ></input>
                        </div>
                        
                        <div class="form-group">
                        <label for="">
                          ingredientes
                        </label>
                        <input name="description" class="form-control" ></input>
                        </div>
                      

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" >enviar</button>
                    </div>
                  </div>
                  </form>
                  @endif
                </div>
              </div>

              <button type="button" class="btn btn-primary ms-1">Siguir</button>
            </div>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-globe fa-lg text-warning"></i>

                <p class="mb-0"></p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                <p class="mb-0">@mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">

            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->username }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
              </div>
              @endauth
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">(097) 234-5678</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mobile</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">(098) 765-4321</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
        </div>
    </div>
</div>

</x-layauts.appPerfil>