<x-app-layout>
    <x-slot name="title">Contacto</x-slot>
    <link rel="stylesheet" href="{{ asset ('css/contacto.css') }}">
    <div class="cont-contact ">
        <div class="content">

            <h1 class="heading">Tu <span>Contacto</span></h1>

            <div class="contact-wrapper animated bounceInUp">
                <div class="contact-form">
                    <h3>Contact us</h3>
                    <form action="{{ route ('contactanos.store') }}" method="POST">

                        @csrf

                        <P>
                            <label>Tu Nombre</label>
                            <input type="text" name="name">
                        </p>
                        
                        <p>
                            <label>Tu Correo Electronico</label>
                            <input type="email" name="email">
                        </p>
                    


                        <p>
                            <label>Tu numero de Telefono</label>
                            <input type="tel" name="phone">
                        </p>
                    
                        <p>
                            <label>Asunto</label>
                            <input type="text" name="affair">
                        </p>
                    
                        <p class="block">
                            <label>Escribe tu Mensaje</label>
                            <textarea name="message" rows="3"></textarea>
                        </p>
                    
                        <p class="block">
                            <button>
                                Enviar
                            </button>
                        </p>
                    </form>
                @if(session('info'))
                    <script>
                        alert("{{session('info')}}");
                    </script>
                @endif
                </div>
                <div class="contact-info">
                    <h4>Mas informacion</h4>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Popayán - Cauca</li>
                        <li><i class="fas fa-phone"></i> (+57) 111 111 111</li>
                        <li><i class="fas fa-envelope-open-text"></i> sena@website.com</li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero provident ipsam necessitatibus repellendus?</p>
                    <p>Senakitch.com</p>
                </div>
            </div>
        </div>
</div>
</x-app-layout>
