<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Vehículo</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ordenes as $i => $o)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $o->cliente->nombre }}</td>
            <td>{{ $o->vehiculo->modelo }}</td>
            <td>{{ $o->estado }}</td>
            <td>{{ $o->fecha_ingreso }}</td>
            <td>{{ number_format($o->total, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
