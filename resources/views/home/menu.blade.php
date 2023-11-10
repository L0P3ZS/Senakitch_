<x-app-layout>
    <x-slot name="title">Menu</x-slot>
    <link rel="stylesheet" href="{{ asset ('css/menu.css') }}">
<section class="menu" id="menu">
    <div class="container" style="margin-top: 80px">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="box-container">
                    @foreach($products as $pro)
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
</x-app-layout>


