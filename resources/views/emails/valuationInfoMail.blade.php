<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo cần nhập kho</title>
</head>

<body>
    <h1 style="text-transform: uppercase; text-align: center;">Khuyến mãi sản phẩm</h1>
    @if($details['valuationBonusContent']==null)

    <div>
        <p>Sản phảm {{$details['coffeeName']}} hiện đang có khuyến mãi:</p>
        <p>Khi mua với số lượng trên {{$details['valuationQuantity']}} bạn sẽ được giảm giá <span style="color: red; font-size: 2rem;"><strong>{{number_format($details['valuationDiscount'])}} đ</strong></span> </p>
        <p>Từ <del>{{number_format($details['coffeePrice'])}} đ</del> chỉ còn <span style="color: red; font-size: 2rem;"><strong>{{number_format($details['valuationPrice'])}} đ</strong></span>!</p>
        <p>Tham khảo thông tin sản phẩm tại <a target="_blank" href="http://127.0.0.1:8000/coffees/{{$details['coffeeSlug']}}">đây</a></p>
    </div>

    @else



    @endif
</body>

</html>