@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle alert-icon"></i>
            <span>
                <b>Advertencia:</b> {{ $error }}
            </span>
            <button type="button" aria-label="Cerrar" class="close" onclick="this.parentElement.style.display='none'">×</button>
        </div>
    @endforeach
@endif

@if(session('successMsg'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle alert-icon"></i>
        <span>
            <b>Listo:</b> {{ session('successMsg') }}
        </span>
        <button type="button" aria-label="Cerrar" class="close" onclick="this.parentElement.style.display='none'">×</button>
    </div>
@endif