<!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
<div class="stat">
    <div class="stat-title">M&aacute;quinas En Uso</div>
    <div class="stat-value">{{ $maquinasEnUso }}</div>
    {{-- <div class="stat-desc">1, 5</div> --}}
</div>

<div class="stat">
    <div class="stat-title">M&aacute;quinas Disponibles</div>
    <div class="stat-value">{{ $maquinasDisponibles }}</div>
    {{-- <div class="stat-desc">2-4, 6-10</div> --}}
</div>

<div class="stat">
    <div class="stat-title">Total de Sesiones</div>
    <div class="stat-value">{{ $summary->totalDeSesiones }}</div>
    {{-- <div class="stat-desc">El d&iacute;a de hoy</div> --}}
</div>

<div class="stat">
    <div class="stat-title">Total Recaudado</div>
    <div class="stat-value">${{ $summary->totalRecaudado }}</div>
    {{-- <div class="stat-desc">El d&iacute;a de hoy</div> --}}
</div>
