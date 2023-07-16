<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      @page {
        size: landscape;
      }
    </style>

    <title>Reporte de Órdenes</title>
  </head>
  <body>

    <div class="container">
      <img src="{{ public_path('assets/logo.png') }}" alt="" width="80px" height="80px" >
      <h2 class="text-center mt-4">Informe de Órdenes</h2>

      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Estado</th>
            <th>Proveedor</th>
            <th>Ref Orden</th>
            <th>Item Orden</th>
            <th>Moneda</th>
            <th>Total</th>
            <th>Fecha de la Orden</th>
          </tr>
        </thead>
        <tbody>
          @php
            $totalOrders = 0;
            $totalAmount = 0;
          @endphp

          @foreach($orders as $order)
            <tr>
              <td>{{ $order->status }}</td>
              <td>{{ $order->provider }}</td>
              <td>{{ $order->reference_order }}</td>
              <td>{{ $order->item_count }}</td>
              <td>{{ $order->currency }}</td>
              <td>{{ number_format($order->total, 0, ',', '.') }}</td>
              <td>{{ $order->created_at }}</td>
            </tr>

            @php
              $totalOrders++;
              $totalAmount += $order->total;
            @endphp
          @endforeach
        </tbody>
        <tfoot>
          <tr class="table-bordered">
            <th colspan="1">Total de Órdenes:</th>
            <td colspan="1">{{ $totalOrders }}</td>
          </tr>
          <tr class="table-bordered">
            <th colspan="1">Monto Total:</th>
            <td colspan="1">{{ number_format($totalAmount, 0, ',', '.') }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </body>
</html>
