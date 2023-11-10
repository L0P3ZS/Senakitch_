@props(['item' => null,'title','modelName','fields'])

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModal Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                @if(Auth::check())
                <form action="{{ $item ? route('admin.' . $modelName . '.update', $item) : route('admin.' . $modelName . '.store') }}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($item)
                        @method('PUT')
                    @endif
                    @foreach($fields as $field)
                    <label for="{{$field['name']}}">{{$field['name']}}</label>
                    <div class="form-group">
                        @switch($field['type'])
                            @case('textarea')
                                <textarea rows="2" cols="50" class="form-control" placeholder="{{$field['name']}}" name="{{$field['name']}}">{{ old($field['name'], $item[$field['name']] ?? '')}}</textarea>
                                @break
                            @case('file')
                                <input class="form-control" name="{{$field['name']}}" type="file" accept="image/*" value="{{ old($field['name'], $item[$field['name']] ?? '')}}">
                                @break
                            @case('password')
                                <input class="form-control" name="{{$field['name']}}" type="password" placeholder="{{ old($field['name'], $item[$field['name']] ?? '')}}">
                                @break
                            @case('email')
                                <input class="form-control" name="{{$field['name']}}" type="email" placeholder="{{$field['name']}}" value="{{ old($field['name'], $item[$field['name']] ?? '')}}">
                                @break
                            @case('select')
                                <select class="form-control" name="{{$field['name']}}">
                                    <option value="opcion1">Opción 1</option>
                                    <option value="opcion2">Opción 2</option>
                                </select>
                                @break
                            @case('number')
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">$</span>
                                        <input class="form-control" name="{{$field['name']}}" type="number" placeholder="0" min="0" value="{{ old($field['name'], $item[$field['name']] ?? '')}}">
                                    </div>
                                </div>
                                @break
                            @default
                                <input class="form-control" name="{{$field['name']}}" type="text" placeholder="{{$field['name']}}" value="{{ old($field['name'], $item[$field['name']] ?? '')}}">
                        @endswitch
                        @error($field['name'])
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    @endforeach
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 <script>
    document.addEventListener('selectedItem', function(event) {
        const item = JSON.parse(event.detail);

        // Obtener todos los campos del formulario
        const formCampos = document.querySelectorAll('#myModal input, #myModal select, #myModal textarea');

        // Recorrer los campos y asignar los valores del item correspondientes
        formCampos.forEach(campo => {
            const campoName = campo.getAttribute('name');
            if (campoName in item) {
                campo.value = item[campoName];
            }
        });
        $('#myModal').modal('show');
    });
</script> 