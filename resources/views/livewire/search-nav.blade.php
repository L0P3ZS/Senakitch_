<div>
    <link rel="stylesheet" href="{{ asset('css/shared/productos.css')}}">
    <link rel="stylesheet" href="{{ asset('css/home/recetas/recetas.css')}}">
    <link rel="stylesheet" href="{{ asset ('css/menu.css') }}">
    {{-- <div class="search-form">
        <input type="search" wire:model.live="search" id="search-box" placeholder="Que estas buscando...">
        <label for="search-box" class="fas fa-search"></label>
    </div> --}}
    <style>
        .cont-results-search{
            position: absolute;
            right: 0;
            top: 100%;
            color: aqua;
            width:100vw;
            /* height: 100vh; */
            overflow-x: hidden;
            background-color:#000
        }
    </style>
    
    <input type="text" class="inline-flex rounded-md" wire:model.live="search" placeholder="buscar"> 
    <div class="cont-results-search">
        @if ($items)
            <section class="products" id="products">   
                    <div class="box-container">
                    @foreach($items['Products'] as $row)
                        <div class="box">
                            <div class="icons">
                                <a href="#" class="fas fa-shopping-cart"></a>
                                <a href="#" class="fas fa-heart"></a>
                                <a href="#" class="fas fa-eye modal-popup" ></a>
                            </div>
                            <div class="image">
                                <img src="{{ asset('storage/' . $row->image) }}" alt="">
                            </div>
                            <div class="content">
                                <h3>{{ $row->name}}</h3>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                {{-- detalle --}}
                                <div class="modal-frame">
                                    <div class="modal-body">
                                        <div class="modal-inner">
                                            <button id="close" class="close"><i class="fas fa-times"></i></button>
                                            <img src="{{ asset('storage/' . $row->image) }}" alt="Image">
                                            <p>{{ $row->description}}</p>
                                        </div>
                                    </div>
                                    <div class="modal-overlay"></div>
                                </div>
            
                                <div class="price">{{ $row->price }} <span>{{ $row->price }}</span></div>
                            </div>
                        </div>
                    @endforeach
                    </div>
            </section>
        
            <section class="blogs" id="blogs">
                    <div class="box-container">
                    @foreach($items['Recipes']  as $row)
                    <div class="box">
                        <div class="image">
                        <img src="{{ asset('storage/' . $row->images) }}" alt="">
                        </div>
                        <div class="content">
                        <a href="#" class="title">{{ $row->name}}</a>
                        <span>by Daniel García / 21 mayo, 2022</span>
                        <p class="overflow-ellipsis">{{$row->ingredients }}</p>
                        <a href="{{route ('verRecetas',$row) }}" class="btn">leer mas</a>
                        </div>
                    </div>
                    @endforeach
                    </div>
            </section>

            <section class="menu" id="menu">
                <div class="container" style="margin-top: 80px">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="box-container">
                                @foreach($items['Menus']  as $pro)
                                    <div class="box">
                                        <div class="card"> 
                                        {{-- si no tien / usa images si no storage --}}
                                        @if (strpos($pro->image_path, '/') === false)
                                            <img src="/images/{{ $pro->image_path }}" alt="{{ $pro->image_path }}">
                                        @else
                                            <img src="{{ asset('storage/' . $pro->image_path) }}" alt="{{ $pro->name }}">
                                        @endif
                                            <div class="card-body">
                                                <a href=""><h6 class="card-title">{{ $pro->name }}</h6></a>
                                                <p class="price">$ {{ $pro->price }} COP</p>
                                                <form action="{{ route('cart.store') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                                    <input type="hidden" value="{{ $pro->name }}" id="name" name="name">
                                                    <input type="hidden" value="{{ $pro->price }}" id="price" name="price">
                                                    <input type="hidden" value="{{ $pro->image_path }}" id="img" name="img">
                                                    <!-- <input type="hidden" value="{{ $pro->slug }}" id="slug" name="slug"> -->
                                                    <input type="hidden" value="1" id="quantity" name="quantity">
                                                    <div class="card-footer">
                                                        <div class="row">
                                                            <button >
                                                                agregar al carrito
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        @endif
    </div>
</div>
