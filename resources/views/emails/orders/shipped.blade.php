<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail Message</title>
</head>
<body>
    <h1>Encomenda # {{$orderId}} foi enviada.</h1>
    <h3>Nome na encomenda: {{$orderName}}</h3>
    <h3>Valor total: {{$orderPrice}}</h3>
    <p>To access the order receipt click

    </p>
</body>
</html>

{{-- <a href="{{route('order.receipt', ['id' => $orderId]) }}">here</a> --}}
