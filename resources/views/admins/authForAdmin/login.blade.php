@extends('layouts/authAdmin')

@section('content')

<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
    <div class="col-md-4 col-md-4 col-sm-4 col-xs-12">
        <div class="text-center m-b-md custom-login">
            <h3 class="text-success">ĐĂNG NHẬP QUẢN TRỊ</h3>
            <i><p class="text-success" style="text-transform: capitalize;">Mỗi ngày đi làm là một niềm <span style="text-decoration: line-through;">đau</span> vui. </p></i>
        </div>
        <div class="hpanel">
            <div class="panel-body">
                <form action="{{ route('admins.login.submit') }}" method="POST" id="loginForm">
                    @csrf
                    
                    <div class="form-group">
                        <label class="control-label" for="username">EMAIL</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>Email hoặc mật khẩu sai</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password">MẬT KHẨU</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="checkbox login-checkbox">
                        <label><input class="form-check-input i-checks" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Nhớ tài khoản </label>
                    </div>
                    <button class="btn btn-success btn-block loginbtn">ĐĂNG NHẬP</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
</div>

@endsection