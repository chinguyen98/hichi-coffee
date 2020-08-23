<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo cần nhập kho</title>
</head>

<body>
    <h1 style="text-transform: uppercase; text-align: center;">Thông báo cần nhập kho</h1>
    <table border="1px" style="border-collapse: collapse;">
        <tr style="background-color: aqua;">
            <th>Mã Sản Phẩm</th>
            <th>Tên Sản Phẩm</th>
            <th>Số lượng kho</th>
            <th>Số lượng đặt</th>
            <th>Số lượng cần</th>
        </tr>
        @foreach($details['needMoreCoffee'] as $item)
        <tr>
            <td>{{$item->id_coffee}}</td>
            <td>{{$item->coffee_name}}</td>
            <td>{{$item->quantity}}</td>
            <td>{{$item->expected_quantity}}</td>
            <td>{{$item->need}}</td>
        </tr>
        @endforeach
    </table>
    <a target="_blank" href="http://127.0.0.1:8000/admins/manage/warehouse/create">Link</a>
</body>

</html>