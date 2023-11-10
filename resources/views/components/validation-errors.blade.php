
@if ($errors->any())
    <div {{ $attributes }}>
        <div style="color: red" class=" font-medium text-red-600">{{ __('¡Vaya! Algo salió mal.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600" style="color: red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
