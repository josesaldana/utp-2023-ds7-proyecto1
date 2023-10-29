<table class="table w-full">
    <thead>
        <th>M&aacute;quina</th>
        <th>Cliente</th>
        <th>Salida</th>
    </thead>
    <tbody>
        @foreach($sessions as $session)
        <tr>
            <td>{{ $session['maquina'] }}</td>
            <td>{{ $session['cliente'] }}</td>
            <td>{{ $session['tiempo'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>