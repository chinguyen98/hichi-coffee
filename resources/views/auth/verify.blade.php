@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="customerForm card my-5">
                <div class="card-header"><b>Xác nhận địa chỉ email</b></div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    Để tiếp tục, vui lòng kiểm tra địa chỉ email của bạn để xác nhận tài khoản.
                    Nếu chưa nhận được email,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Nhấn vào đây để gửi lại email xác nhận</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
