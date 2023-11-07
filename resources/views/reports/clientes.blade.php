<h2 class="text-2xl">Reporte de Clientes</h2>

<div class="stats shadow col-span-full flex flex-row w-full mt-5">
    <div class="stat">
        <div class="stat-title">Fumadores</div>
        <div class="stat-value">{{ $fumadores }}</div>
    </div>

    <div class="stat">
        <div class="stat-title">No Fumadores</div>
        <div class="stat-value">{{ $nofumadores}}</div>
    </div>
</div>

<table class="table mt-8">
    <thead>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Es Fumador</th>
        <th>Horas alquiladas</th>
        <th>M&aacute;quinas Utilizadas</th>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
        <tr>
            <td>{{ $cliente['nombre'] }}</td>
            <td>{{ $cliente['apellido'] }}</td>
            <td>{{ $cliente['fuma'] ? "Sí" : "No" }}</td>
            <td>{{ $cliente['horasAlquiladas'] }}</td>
            <td>{{ $cliente['maquinasUtilizadas'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>