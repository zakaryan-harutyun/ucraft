@if ($flash = session('success'))
    <div id="flash-message" class="alert alert-success">
        {{ $flash }}
    </div>
@endif
@if ($flash = session('failed'))
    <div id="flash-message" class="alert alert-danger ">
        {{ $flash }}
    </div>
@endif
