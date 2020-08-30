<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-8 heading-section ftco-animate text-center">
                <span class="subheading mb-1">Khám phá</span>
                <h2 class="mb-4">Sản phẩm đang khuyến mãi</h2>
                <p><b style="color: peru; font-size: 25px;" class="slogan-index"><i>Đen tối như ác quỷ, nóng bỏng như địa ngục<br> trong lành như thiên thần, ngọt ngào như tình yêu.</i></b></p>
            </div>
        </div>
        <div class="row">
            @foreach($promotionCoffees as $coffee)

            <div class="col-md-3">
                <div class="menu-entry">
                    <a href="{{route('customer.coffees.show', ['slug'=> $coffee->slug])}}" class="img" style="background-image: url(/apps/images/coffees/{{$coffee->image}});"></a>
                    <div class="text text-center pt-4">
                        <h3><a class="text-primary " href="{{route('customer.coffees.show', ['slug'=> $coffee->slug])}}">{{$coffee->name}}</a></h3>
                        <p class="price"><span style="color: red; font-size: 20px;">{{number_format($coffee->price)}} đ</span></p>
                        <p><a href="{{route('customer.coffees.show', ['slug'=> $coffee->slug])}}" class="btn btn-primary btn-outline-primary">Xem chi tiết</a></p>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</section>