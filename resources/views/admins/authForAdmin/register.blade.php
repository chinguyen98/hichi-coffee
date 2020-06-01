@extends('layouts/authAdmin')

@section('content')

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
    <div class="col-md-6 col-md-6 col-sm-6 col-xs-12">
        <div class="text-center custom-login text-danger">
            <h3>Đăng kí tài khoản quản trị viên</h3>
            <p>Mỗi ngày đi làm là một niềm đau. </p>
        </div>
        <div class="hpanel">
            <div class="panel-body">
                <form action="#" id="loginForm">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Tên nhân viên:</label>
                            <input class="form-control">
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Địa chỉ</label>
                            <input class="form-control">
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Xác nhận mật khẩu</label>
                            <input type="password" class="form-control">
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-success loginbtn" value="Tạo mới">
                        <input type="reset" class="btn btn-default" value="Nhập lại" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
</div>

@endsection