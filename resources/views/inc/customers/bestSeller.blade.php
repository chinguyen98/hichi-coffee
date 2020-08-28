<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-8 heading-section ftco-animate text-center">
                <span class="subheading mb-1">Khám phá</span>
                <h2 class="mb-4">Sản phẩm bán chạy nhất</h2>
                <p><b><i style="color: peru; font-size: 25px;" class="slogan-index">Cà phê khiến ta mạnh mẽ, nghiêm nghị và thông thái <br>Một ly cà phê ngon là phải vừa ngọt vừa đắng.</i></b></p>
            </div>
        </div>
        <div class="row">
            @foreach($bestCoffeeSellers as $coffee)

            <div class="dmsp-main-container__item col-md-3">
                <div class="menu-entry">
                    <a href="{{route('customer.coffees.show', ['slug'=> $coffee->slug])}}" class="img" style="background-image: url(/apps/images/coffees/{{$coffee->image}});"></a>
                    <div class="text text-center pt-4">
                        <h3><a class="text-primary" href="{{route('customer.coffees.show', ['slug'=> $coffee->slug])}}">{{$coffee->name}}</a></h3>
                        <p class="price"><span style="color: red; font-size: 20px;"><b>{{number_format($coffee->price)}} đ</b></span></p>
                        <p><a href="{{route('customer.coffees.show', ['slug'=> $coffee->slug])}}" class="btn btn-primary btn-outline-primary">Xem chi tiết</a></p>
                    </div>
                </div>
                @if($coffee->haveValuation!=0)

                <div style="top: -5rem; left: -4.5rem;" class="sale">
                    <img src="/apps/images/sale.png" alt="">
                </div>

                @endif
            </div>

            @endforeach
        </div>
    </div>
</section>