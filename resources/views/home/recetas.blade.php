<x-app-layout >
    <x-slot name="title">Recetas</x-slot>

   {{-- <link rel="stylesheet" href="{{ asset('css/style.css')}}">  --}}
   <link rel="stylesheet" href="{{ asset('css/home/recetas/recetas.css')}}">
   <section class="blogs" id="blogs">
    <h1 class="heading"> nuestras <span>recetas </span> </h1>
    <div class="box-container">
    @foreach($recetas as $row)
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

  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
  <script src="{{ asset('js/jm.js') }}"></script>
</x-app-layout>