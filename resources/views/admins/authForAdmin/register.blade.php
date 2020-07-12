@extends('layouts/authAdmin')

@section('content')

<div class="row mt-5">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
    <div class="col-md-6 col-md-6 col-sm-6 col-xs-12">
        <div class="text-center custom-login text-danger">
            <h3 style="text-transform: uppercase;">Đăng kí tài khoản quản trị viên</h3>
            <i>
                <p style="text-transform: capitalize;">Mỗi ngày đi làm là một niềm <span style="text-decoration: line-through;">đau</span> vui. </p>
            </i>
        </div>
        <div class="hpanel">
            <div class="panel-body">
                <form action="/admins/register" method="POST" id="loginForm">
                    @csrf

                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label style="text-transform: uppercase;">Tên nhân viên</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-12">
                            <label style="text-transform: uppercase;">Email:</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-12">
                            <label style="text-transform: uppercase;">Mật khẩu</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-12">
                            <label style="text-transform: uppercase;">Xác nhận mật khẩu</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group col-lg-12">
                            <select name="id_city" class="form-control custom-select custom-select-lg mb-3">
                                <!-- Cities -->
                            </select>
                            <br>
                            <select name="id_district" class="form-control custom-select custom-select-lg mb-3">
                                <option value="-1" selected>Chọn quận/huyện</option>
                                <!-- Districts -->
                            </select>
                            <br>
                            <select name="id_ward" class="form-control custom-select custom-select-lg mb-3">
                                <option value="-1" selected>Chọn phường/xã</option>
                                <!-- Districts -->
                            </select>
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="address" style="text-transform: uppercase;">Địa chỉ:</label>
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="phone_number" style="text-transform: uppercase;">Số điện thoại:</label>
                            <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                            @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-success loginbtn" value="TẠO TÀI KHOẢN">
                        <input type="reset" class="btn btn-default" value="NHẬP LẠI" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
</div>
<script src="/apps/js/loadAddressInfo.js"></script>

@endsection
