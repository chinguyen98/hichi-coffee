<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        th,
        td {
            border: 1px solid white;
            padding: 5px;
        }

        td {
            background-color: rgb(226, 223, 223);
        }
    </style>
</head>

<body>
    <div style="width: fit-content; width: 45rem;">
        <p><b>Cảm ơn quý khách <span style="text-transform: uppercase;">{{$details['name']}}</span> đã đặt hàng tại Hichi Coffee</b>
        </p>
        <p>Hichi Coffee rất vui thông báo đơn hàng <u style="color: rgb(78, 171, 247);">#{{$details['idOrder']}}</u> của quý khách đã được
            tiếp nhận và đang trong quá trình xử lý.
        </p>
        <p><span style="text-transform: uppercase;color: rgb(78, 171, 247);">Thông tin đơn hàng
                <b><u>#{{$details['idOrder']}}</u></b></span> <span style="color: gray;">(Ngày {{$details['date_created']}})</span></p>
        <div>
            <div style="display: inline-block; margin-left: 2rem;">
                <p><b>Thông tin thanh toán</b></p>
                <p><span style="text-transform: uppercase;">{{$details['name']}}</span></p>
                <p><u style="color: rgb(78, 171, 247);">{{$details['email']}}</u></p>
            </div>
            <div style="display: inline-block; margin-left: 4rem;">
                <p><b>Địa chỉ giao hàng</b></p>
                <p style="color: rgb(78, 171, 247);">{{$details['address']}}</p>
                <br>
            </div>
        </div>
        <div>
            <p><b>Phương thức thanh toán:</b> Thanh toán phương thức COD.</p>
            <p><b>Phí vận chuyển:</b> {{number_format($details['shippingPrice'])}} đ.</p>
        </div>
        <p style="text-transform: uppercase;color: rgb(78, 171, 247);"><b>Chi tiết đơn hàng</b></p>
        <table style="border-collapse: collapse;">
            <tr style="background-color: rgb(134, 194, 243); color: white; text-align: left;">
                <th>Sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Giảm giá</th>
                <th>Tổng tạm</th>
            </tr>

            @foreach($details['cartForMail'] as $cart)

            <tr>
                <td>{{$cart->name}}</td>
                <td>{{number_format($cart->oldPrice)}} đ</td>
                <td>{{$cart->quantity}}</td>
                <td>{{number_format($cart->discountPrice)}} đ</td>
                <td>{{number_format($cart->newPrice)}} đ</td>
            </tr>

            @endforeach

            <tr>
                <td colspan="4" style="text-align: right;">
                    Tổng giá trị sản phẩm chưa giảm
                </td>
                <td>{{number_format($details['beforeDiscountPrice'])}} đ</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">
                    Giảm giá
                </td>
                <td>{{number_format($details['totalDiscountPrice'])}} đ</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">
                    Chi phí vận chuyển
                </td>
                <td>{{number_format($details['shippingPrice'])}} đ</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">
                    Tổng giá trị đơn hàng
                </td>
                <td>{{number_format($details['totalPrice'])}} đ</td>
            </tr>
        </table>
        <p style="border: 1px dotted black;">Hichi Coffee sẽ không gửi tin nhắn SMS khi đơn hàng của bạn được xác nhận
            thành công. Chúng tôi chỉ liên hệ trong trường hợp đơn hàng có thể bị trễ hoặc không liên hệ giao hàng.</p>
        <p>Bạn cần hổ trợ ngay? Chỉ cần email <span style="color: rgb(14, 233, 25);"><b>dacchiclone@gmail.com</b></span>
            hoặc gọi vào số điện thoại <b style="color: rgb(78, 171, 247);">037123456</b> <span style="color: gray;">(8-21h cả thứ 7 và chủ nhật)</span>, Đội ngũ Hichi Care luôn sẵn sàng hỗ trợ bạn
            bất kỳ lúc nào.</p>
    </div>

</body>

</html>