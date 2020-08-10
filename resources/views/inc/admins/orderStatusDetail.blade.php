<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="product-status-wrap">
        <h4>CHI TIẾT ĐƠN HÀNG <span style="color: orangered;">#{{$orderStatus->order->id}}</span> - {{$orderStatus->status->name}}</h4>
        <div class="order row ">
            <h5><b>ĐỊA CHỈ NGƯỜI NHẬN</b></h5>
            <i>Tên Khách Hàng:</i><span style="color: brown; margin-left: 10px;"><b>{{$orderStatus->order->customer->name}}</b></span>
            <div>
                <i>Địa Chỉ:</i><span style="margin-left: 4.7em;">{{$orderStatus->order->full_address}}</span>
            </div>
            <div>
                <i>Số Điện Thoại</i><span style="margin-left: 2em;">{{$orderStatus->order->customer->phone_number}}</span>
            </div>
        </div>
        <br>
        <div class="order row ">
            <h5><b>HÌNH THỨC GIAO HÀNG</b></h5>
            <i style="color: green;">{{$orderStatus->order->shipping_type->name}}</i>
        </div>
        <br>
        <div class="order row ">
            <h5><b>HÌNH THỨC THANH TOÁN</b></h5>
            <i style="color: orangered;">Thanh toán sau khi nhận hàng (#COD)</i>
        </div>
        <br>
        <table>
            <tr>
                <th>Mã Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá Gốc</th>
                <th>Số Lượng</th>
                <th>Giảm Giá</th>
                <th>Tạm Tính</th>
            </tr>
            @foreach($orderStatus->order->order_details as $item)
            <tr>
                <td>{{$item->coffee->id}}</td>
                <td>{{$item->coffee->name}}</td>
                <td>{{$item->coffee->price}}</td>
                <td>{{$item->quantity}}</td>
                @if($item->valuation_detail($item->id_order, $item->id_coffee) )

                <td>{{$item->valuation_detail($item->id_order, $item->id_coffee)->valuation->discount}}</td>
                @else

                <td>0</td>
                @endif


                @if($item->valuation)
                <td>{{$item->coffee->price-$item->valuation->discount}}</td>
                @else
                <td>{{$item->coffee->price}}</td>

                @endif
            </tr>
            @endforeach
        </table>
        <br>
        <div class="order row text-right total ">
            <div>
                <h5><span style="margin-right: 5.4em;">Tạm tính:</span> {{number_format($orderStatus->order->total_price-($orderStatus->order->shipping_type->price+$orderStatus->order->shipping_address->price))}} </h5>
            </div>
            <div>
                <h5><span style="margin-right: 4.1em;">Phí vận chuyển:</span>{{number_format($orderStatus->order->shipping_type->price+$orderStatus->order->shipping_address->price)}} </h5>
            </div>
            <div>
                <h4><span class="spanaa">Tổng tiền:</span> <span style="color: red;">{{number_format($orderStatus->order->total_price)}} </span></h4>
            </div>

        </div>

    </div>

</div>