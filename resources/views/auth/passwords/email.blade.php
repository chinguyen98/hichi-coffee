@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 mt-5">
            <div class="customerForm card mt-5">
                <div class="card-header">Tìm tài khoản của bạn</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            Chúng tôi đã gửi email phục hồi mật khẩu cho bạn!
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <p class="text-primary">Vui lòng nhập email để tìm kiếm tài khoản.</p>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Địa chỉ email  </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Địa chỉ email này chưa đăng ký!</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Gửi yêu cầu tìm tài khoản
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
