@if ($errors->any() || session('error_messages'))
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
            @if(session('error_messages'))
                <li>{{ session('error_messages') }}</li>
            @endif
        </ul>
    </div>
@endif
