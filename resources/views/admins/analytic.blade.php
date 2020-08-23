@extends('layouts.adminManage')

@section('content')

@if ( Session::has('flash_message') )

@include('inc.admins.messageNotification')

@endif

<div class="income-order-visit-user-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="income-dashone-total reso-mg-b-30">
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-nalika-rate">
                                <h3><span class="counter text-danger">{{number_format($order->totalPrice)}}</span><span style="margin-left: 0.5rem;" class="text-danger">đ</span></h3>
                            </div>
                        </div>
                        <div class="income-range">
                            <p>Tổng danh thu tháng {{date('m')}}</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="income-dashone-total reso-mg-b-30">
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-nalika-rate">
                                <h3><span class="counter">{{$order->sum}}</span></h3>
                            </div>
                        </div>
                        <div class="income-range order-cl">
                            <p>Tổng đơn hàng tháng {{date('m')}}</p>

                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="income-dashone-total reso-mg-b-30 res-mg-t-30">
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-nalika-rate">
                                <h3><span class="counter">{{$coffees->totalCoffee}}</span></h3>
                            </div>

                        </div>
                        <div class="income-range visitor-cl">
                            <p>Tổng sản phẩm</p>

                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="income-dashone-total res-mg-t-30">
                    <div class="income-dashone-pro">
                        <div class="income-rate-total">
                            <div class="price-nalika-rate">
                                <h3><span class="counter">{{$coffee_comment->totalComment}}</span></h3>
                            </div>
                        </div>
                        <div class="income-range low-value-cl">
                            <p>Tổng đánh giá sản phẩm</p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- income order visit user End -->
<div class="dashtwo-order-area mg-tb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analytics-nalika-wrap ant-res-b-30 reso-mg-b-30">
                    <div class="skill-content-3 analytics-nalika">
                        <div class="skill">
                            <div class="progress">
                                <div class="lead-content">
                                    <h3><span class="counter text-danger">{{number_format($order->totalPrice)}}</span><span style="margin-left: 0.5rem;" class="text-danger">đ</span></h3>
                                    <p>Tổng danh thu tháng {{date('m')}}</p>
                                </div>
                                <div class="progress-bar wow fadeInLeft" data-progress="95%" style="width: 95%;" data-wow-duration="1.5s" data-wow-delay="1.2s"> <span>95%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analytics-nalika-wrap reso-mg-b-30">
                    <div class="skill-content-3 analytics-nalika analytics-nalika4">
                        <div class="skill">
                            <div class="progress">
                                <div class="lead-content">
                                    <h3>85%</h3>
                                    <p>Server down 8:32 pm</p>
                                </div>
                                <div class="progress-bar wow fadeInLeft" data-progress="85%" style="width: 85%;" data-wow-duration="1.5s" data-wow-delay="1.2s"><span>85%</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analytics-nalika-wrap reso-mg-b-30 res-mg-t-30">
                    <div class="skill-content-3 analytics-nalika analytics-nalika3">
                        <div class="skill">
                            <div class="progress progress-bt">
                                <div class="lead-content">
                                    <h3>80%</h3>
                                    <p>Server down 10:32 pm</p>
                                </div>
                                <div class="progress-bar wow fadeInLeft" data-progress="80%" style="width: 80%;" data-wow-duration="1.5s" data-wow-delay="1.2s"><span>80%</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analytics-nalika-wrap res-mg-t-30">
                    <div class="skill-content-3 analytics-nalika analytics-nalika2">
                        <div class="skill">
                            <div class="progress progress-bt">
                                <div class="lead-content">
                                    <h3>93%</h3>
                                    <p>Server down 10:32 pm</p>
                                </div>
                                <div class="progress-bar wow fadeInLeft" data-progress="93%" style="width: 93%;" data-wow-duration="1.5s" data-wow-delay="1.2s"><span>93%</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="analytics-sparkle-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Visits in last 24h</h5>
                        <h2 class="counter">5600</h2>
                        <div id="sparkline22"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30">
                    <div class="analytics-content">
                        <h5>Visits week</h5>
                        <h2 class="counter">3400</h2>
                        <div id="sparkline23"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line reso-mg-b-30 res-mg-t-30">
                    <div class="analytics-content">
                        <h5>Last month</h5>
                        <h2 class="counter">3300</h2>
                        <div id="sparkline24"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analytics-sparkle-line res-mg-t-30">
                    <div class="analytics-content">
                        <h5>Avarage time</h5>
                        <h2>00:06:40</h2>
                        <div id="sparkline25"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="analysis-rounded-area mg-tb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analytics-rounded reso-mg-b-30">
                    <div class="analytics-rounded-content">
                        <h5>Percentage distribution</h5>
                        <h2><span class="counter">40</span>/20</h2>
                        <div class="text-center">
                            <div id="sparkline51"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analytics-rounded reso-mg-b-30">
                    <div class="analytics-rounded-content">
                        <h5>Percentage division</h5>
                        <h2><span class="counter">140</span>/<span class="counter">54</span></h2>
                        <div class="text-center">
                            <div id="sparkline52"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analytics-rounded reso-mg-b-30 res-mg-t-30">
                    <div class="analytics-rounded-content">
                        <h5>Percentage Counting</h5>
                        <h2>2345/311</h2>
                        <div class="text-center">
                            <div id="sparkline53"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analytics-rounded res-mg-t-30">
                    <div class="analytics-rounded-content">
                        <h5>Percentage Sequence</h5>
                        <h2>780/56</h2>
                        <div class="text-center">
                            <div id="sparkline54"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="analysis-progrebar-area mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analysis-progrebar reso-mg-b-30">
                    <div class="analysis-progrebar-content">
                        <h5>Usage</h5>
                        <h2><span class="counter">90</span>%</h2>
                        <div class="progress progress-mini">
                            <div style="width: 68%;" class="progress-bar"></div>
                        </div>
                        <div class="m-t-sm small">
                            <p>Server down since 1:32 pm.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analysis-progrebar reso-mg-b-30">
                    <div class="analysis-progrebar-content">
                        <h5>Memory</h5>
                        <h2><span class="counter">70</span>%</h2>
                        <div class="progress progress-mini">
                            <div style="width: 78%;" class="progress-bar"></div>
                        </div>
                        <div class="m-t-sm small">
                            <p>Server down since 12:32 pm.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analysis-progrebar reso-mg-b-30 res-mg-t-30">
                    <div class="analysis-progrebar-content">
                        <h5>Data</h5>
                        <h2><span class="counter">50</span>%</h2>
                        <div class="progress progress-mini">
                            <div style="width: 38%;" class="progress-bar progress-bar-danger"></div>
                        </div>
                        <div class="m-t-sm small">
                            <p>Server down since 8:32 pm.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="analysis-progrebar res-mg-t-30">
                    <div class="analysis-progrebar-content">
                        <h5>Space</h5>
                        <h2><span class="counter">40</span>%</h2>
                        <div class="progress progress-mini">
                            <div style="width: 28%;" class="progress-bar progress-bar-danger"></div>
                        </div>
                        <div class="m-t-sm small">
                            <p>Server down since 5:32 pm.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection