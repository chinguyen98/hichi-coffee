<section class="ftco-menu">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Khám phá</span>
                <h2 class="mb-4">Sản phẩm của chúng tôi</h2>
                <p>Đàn ông rất giống cà phê <br> bởi nếu là loại ngon sẽ làm bạn mất ngủ!</p>
            </div>
        </div>
        <div class="row d-md-flex">
            <div class="col-lg-12 ftco-animate p-md-5">
                <div class="row">
                    <div class="col-md-12 nav-link-wrap mb-5">
                        <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @isset($brands)

                            @foreach($brands as $key => $brand)

                            @if($key===0)

                            <a class="nav-link active" id="v-pills-{{$key+1}}-tab" data-toggle="pill" href="#v-pills-{{$key+1}}" role="tab" aria-controls="v-pills-{{$key+1}}" aria-selected="true">{{$brand->name}}</a>

                            @else

                            <a class="nav-link" id="v-pills-{{$key+1}}-tab" data-toggle="pill" href="#v-pills-{{$key+1}}" role="tab" aria-controls="v-pills-{{$key+1}}" aria-selected="false">{{$brand->name}}</a>

                            @endif

                            @endforeach

                            @endisset
                        </div>
                    </div>
                    <div class=" col-md-12 d-flex align-items-center">

                        <div class="tab-content ftco-animate" id="v-pills-tabContent">

                            @isset($brands)

                            @foreach($brands as $key => $brand)

                            @if($key===0)

                            <div class="tab-pane fade show active" id="v-pills-{{$key+1}}" role="tabpanel" aria-labelledby="v-pills-{{$key+1}}-tab">
                                <div class="row">

                                    @foreach($brand->coffees as $k=>$coffee)

                                    @if($k===6)

                                    @break

                                    @else

                                    <div class="col-md-4 text-center">
                                        <div class="menu-wrap">
                                            <a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}" class="menu-img img mb-4" style="background-image: url(apps/images/coffees/{{$coffee->image}});"></a>
                                            <div class="text">
                                                <h3><a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}">{{$coffee->name}}</a></h3>
                                                <p class="price"><span>{{number_format($coffee->price)}} VND</span></p>
                                                <p><a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}" class="btn btn-primary btn-outline-primary">XEM SẢN PHẨM</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    @endif

                                    @endforeach

                                </div>
                            </div>

                            @else

                            <div class="tab-pane fade" id="v-pills-{{$key+1}}" role="tabpanel" aria-labelledby="v-pills-{{$key+1}}-tab">
                                <div class="row">

                                    @foreach($brand->coffees as $k=>$coffee)

                                    @if($k===6)

                                    @break

                                    @else

                                    <div class="col-md-4 text-center">
                                        <div class="menu-wrap">
                                            <a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}" class="menu-img img mb-4" style="background-image: url(apps/images/coffees/{{$coffee->image}});"></a>
                                            <div class="text">
                                                <h3><a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}">{{$coffee->name}}</a></h3>
                                                <p class="price"><span>{{number_format($coffee->price)}} VND</span></p>
                                                <p><a href="{{route('customer.coffees.show', ['slug'=>$coffee->slug])}}" class="btn btn-primary btn-outline-primary">XEM SẢN PHẨM</a></p>
                                            </div>
                                        </div>
                                    </div>

                                    @endif

                                    @endforeach

                                </div>
                            </div>

                            @endif

                            @endforeach

                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>