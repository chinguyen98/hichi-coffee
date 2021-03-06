@extends('layouts.adminManage')

@section('content')
@if ( Session::has('flash_message') )

@include('inc.admins.messageNotification')

@endif

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">

            @if(count($needMoreCoffee)!=0)

            @if(Auth::user()->isSuperAdmin())

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="product-status-wrap">
                    <h1 style="color: orangered;">DANH SÁCH SẢN PHẨM CẦN NHẬP KHO</h1>
                    <span class="input-group-addon"><i><b style="color:yellowgreen;">CHỌN NHÀ CUNG CẤP</b></i></span>
                    <select form="formInput" name="id_supplier" class="form-control pro-edt-select form-control-primary">
                        @foreach($suppliers as $supplier)

                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>

                        @endforeach
                    </select>
                    <table>
                        <tr>
                            <th>Mã Sản Phẩm</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số lượng kho</th>
                            <th>Số lượng đặt</th>
                            <th>Số lượng cần</th>
                            <th>Nhập</th>
                        </tr>
                        @foreach($needMoreCoffee as $item)
                        <tr>
                            <td>{{$item->id_coffee}}</td>
                            <td>{{$item->coffee_name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->expected_quantity}}</td>
                            <td>{{$item->need}}</td>
                            <td>
                                <input class="text-success" type="number" name="id_coffee" id="{{$item->id_coffee}}" form="formInput" required>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <hr style="border: 1px solid red;">
                    <input style="margin-left: 40em; " type="submit" form="formInput" class="btn btn-success text-success" value="NHẬP KHO" />
                </div>
            </div>

            @else

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <table>
                        <tr>
                            <th>Mã Sản Phẩm</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số lượng kho</th>
                            <th>Số lượng đặt</th>
                            <th>Số lượng cần</th>
                        </tr>
                        @foreach($needMoreCoffee as $item)
                        <tr>
                            <td>{{$item->id_coffee}}</td>
                            <td>{{$item->coffee_name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->expected_quantity}}</td>
                            <td>{{$item->need}}</td>
                        </tr>
                        @endforeach
                    </table>
                    <form action="{{route('admins.manage.order.sendQtyMail', ['id'=>$orderStatus->order->id])}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success" style="margin-top: 1rem; text-transform: uppercase;">Gửi mail thông báo cho Super Admin</button>
                    </form>
                </div>
            </div>

            @endif

            @endif

            @if(count($needMoreCoffee)==0)

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h1 style="color: orangered; text-align: center;">ĐƠN HÀNG ĐÃ SẲN SÀNG ĐƯỢC GIAO</h1>
                </div>
            </div>

            @endif

            @include('inc.admins.orderStatusDetail')

            @if(count($needMoreCoffee)==0)

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <form action="{{route('admins.manage.order.ship.update',['id'=>$orderStatus->order->id])}}" method="post">
                        @csrf
                        <label style="color: red;" for="note"><i><u>Ghi Chú</u></i></label><input style="margin-left: 5px; margin-right: 5px;" type="text" name="note" id="note">
                        <input type="submit" class="btn btn-success text-right" value="GIAO CHO ĐƠN VỊ VẬN CHUYỂN" />
                    </form>
                </div>
            </div>

            @endif

            @if(count($needMoreCoffee)!=0 && Auth::user()->isSuperAdmin())

            <form method="POST" onsubmit="return createDataSubmit()" id="formInput" action="{{route('admins.manage.order.receive.addCoffee')}}">
                @csrf
                <input type="hidden" name="data" value="[]">
            </form>

            @endif

        </div>
    </div>
</div>

@if(count($needMoreCoffee)!=0 && Auth::user()->isSuperAdmin())

<script>
    const listCoffeeInput = [...document.querySelectorAll('input[name="id_coffee"]')];

    function createDataSubmit() {
        //value="[{"coffeeId":"4","quantity":"500"}]"
        const data = listCoffeeInput.map(item => {
            return {
                "coffeeId": item.id,
                "quantity": item.value
            };
        });

        //console.log(data);
        document.querySelector('input[name="data"]').value = JSON.stringify(data);

        return true;
    }
</script>

@endif

@endsection