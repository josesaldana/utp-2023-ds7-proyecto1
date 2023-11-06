@if(count($sessions) > 0)
<table class="table w-full">
    <thead>
        <th>M&aacute;quina</th>
        <th>Cliente</th>
        <th>Tiempo Restante</th>
    </thead>
    <tbody>
        @foreach($sessions as $session)
        <tr>
            <td>{{ $session->maquina }}</td>
            <td>{{ $session->cliente }}</td>
            <td>{{ $session->tiempoRestante() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>   
@else
<p>No hay sesiones activas en este momento.</p>
@endif