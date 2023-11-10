{{-- table --}}
<link rel="stylesheet" href="{{ asset ('css/shared/codelab_ui/table1.css') }}"> 
<div class="card">
    <div class="card-header">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Agregar</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="tabla table-hover text-center">
                <thead class="thead-primary">
                    <tr>
                        @foreach ($fields as $field)
                            <th>{{$field['name']}}</th>
                        @endforeach
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($items as $item)
                        <tr >
                            @foreach ($fields as $field)
                            <td class="p-0">
                                @if ($field['type'] === "file")
                                    @if (file_exists(public_path('storage/' . $item[$field['name']])))
                                        <img src="{{ asset('storage/' . $item[$field['name']]) }}" alt="{{ $item[$field['name']] }}" class="img-thumbnail rounded-circle imagen" width="60">
                                    @endif 
                                    
                                @else
                                    {{ $item[$field['name']] }}
                                @endif
                            </td>
                            @endforeach
                            <td class="p-0">
                                    <button type="submit" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success btn-sm"> <i class="fas fa-pencil-alt"></i>
                                       
                                        @php
                                            $editItem = $item;
                                        @endphp   
                                    </button>
                                <form action="{{route('admin.' . $modelName . '.destroy',$item)}}" method="post" style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModal Label">{{ $titleModal }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(Auth::check())
                <form action="{{route('admin.' . $modelName . '.store') }}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($editItem === array)
                        <p>no es null</p>
                        @method('PUT')
                    @else
                    <p>caca NO HAY ITEM</p>
                    @endif 
                    @foreach($fields as $field)
                    <label for="{{$field['name']}}">{{$field['name']}}</label>
                    <div class="form-group">
                        @switch($field['type'])
                            @case('textarea')
                                <textarea rows="2" cols="50" class="form-control" placeholder="{{$field['name']}}" name="{{$field['name']}}">{{ old($field['name'])}}</textarea>
                                @break
                            @case('file')
                                <input class="form-control" name="{{$field['name']}}" type="file" accept="image/*" value="{{ old($field['name'])}}">
                                @break
                            @case('password')
                                <input class="form-control" name="{{$field['name']}}" type="password" placeholder="{{ old($field['name'], $item[$field['name']] ?? '')}}">
                                @break
                            @case('email')
                                <input class="form-control" name="{{$field['name']}}" type="email" placeholder="{{$field['name']}}" value="{{ old($field['name'])}}">
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
                                        <input class="form-control" name="{{$field['name']}}" type="number" placeholder="0" min="0" value="{{ old($field['name'])}}">
                                    </div>
                                </div>
                                @break
                            @default
                                <input class="form-control" name="{{$field['name']}}" type="text" placeholder="{{$field['name']}}" >
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