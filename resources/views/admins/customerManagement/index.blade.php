@extends('layouts.adminManage')

@section('content')

@if ( Session::has('flash_message') )

@include('inc.admins.messageNotification')

@endif

<div class="product-status mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="product-status-wrap">
                    <h4 style="color: yellowgreen;">DANH SÁCH KHÁCH HÀNG</h4>
                    <br>
                    <table id="data">
                        <thead>
                            <tr>
                                <th style="color: darksalmon;">MÃ KHÁCH HÀNG</th>
                                <th style="color: darksalmon;">TÊN KHÁCH HÀNG</th>
                                <th style="color: darksalmon;">NGÀY TẠO TÀI KHOẢN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)

                            <tr>
                                <td style="padding-left: 4em;">{{$customer->id}}</td>
                                <td style="padding-left: 1.5em;">
                                    {{$customer->name}}
                                </td>
                                <td style="padding-left: 3em;">{{date("d/m/Y", strtotime($customer->created_at))}}</td>
                                <td>
                                    <a href="{{route('admins.manage.user.detail', ['id'=>$customer->id])}}" data-toggle="tooltip" title="Xem Chi Tiết" class="btn pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                </td>
                            </tr>


                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="/admins/js/jquery-3.5.1.min.js">
</script>
<script>
    $(document).ready(function() {
        $('#data').DataTable();

    });
</script>

@endsection