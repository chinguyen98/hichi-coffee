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
                    <h4 style="color: darkturquoise;">DANH SÁCH TIN TỨC</h4>
                    <div class="add-product">
                        <a href="{{route('admins.manage.news.create')}}"><b style="color: darkturquoise;">THÊM MỚI</b></a>
                    </div>
                    <table id="data">
                        <thead>
                            <tr>
                                <th>MÃ TIN</th>
                                <th>TIÊU ĐỀ</th>
                                <th>HÌNH ẢNH</th>
                                <th>TÙY CHỌN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listnews as $news)

                            <tr>
                                <td>{{$news->id}}</td>
                                <td>{{$news->title}}</a></td>
                                <td><img src="/apps/images/news/{{$news->image}}" alt="" /></td>
                                <td>
                                    <a href="{{route('admins.manage.news.renderNewUpdate', ['id'=>$news->id])}}" data-toggle="tooltip" title="Cập Nhật" class="btn pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <div class="custom-pagination">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </div>
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