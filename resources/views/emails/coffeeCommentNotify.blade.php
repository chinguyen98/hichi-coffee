<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hichi-Coffee</title>
</head>

<body style="padding: 1rem 3rem;">
    <h2 style="text-align: center;">Hichi-Coffee thông báo</h2>
    <div>
        <p>Bạn đã có một đánh giá sản phẩm {{$details['coffeeName']}} vào ngày {{date("d-m-Y", strtotime($details['created_at']))}}</p>
        <p>Chúng tôi nhận thấy đánh giá của bạn đã vi phạm tiêu chuẩn cộng đồng!</p>
        <p>Xin vui lòng đánh giá lại sản phẩm tại đường dẫn: </p>
        <a href="http://127.0.0.1:8000/coffees/{{$details['coffeeSlug']}}#flag">{{$details['coffeeName']}}</a>
        <p>Chúng tôi xin cảm ơn bạn!</p>
    </div>
</body>

</html>