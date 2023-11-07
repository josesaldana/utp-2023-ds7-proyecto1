<h2 class="text-2xl">Reporte Financiero</h2>

<div class="stats shadow col-span-full flex flex-row w-full mt-5">
    <div class="stat">
        <div class="stat-title">Total Recaudado</div>
        <div class="stat-value">{{ $totalRecaudado }}</div>
    </div>
</div>

<table class="table mt-8">
    <thead>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Horas alquiladas</th>
        <th>Total Generado</th>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{ $cliente['nombre'] }}</td>
            <td>{{ $cliente['apellido'] }}</td>
            <td>{{ $cliente['horasAlquiladas'] }}</td>
            <td>$ {{ $cliente['totalGenerado'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>