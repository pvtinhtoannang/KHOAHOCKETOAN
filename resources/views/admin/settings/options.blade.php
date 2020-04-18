@extends('admin.dashboard.dashboard-master')
@section('title', 'Cài đặt tổng quan')
@section('content')
    <h1 class="template-title">Tuỳ chọn tổng quan</h1>
    <form class="kt-form" method="POST" action="{{route('POST_MY_PROFILE')}}">
        @csrf
        <div class="kt-portlet__body">
            <div class="form-group form-group-last">
                <div class="alert alert-secondary" role="alert">
                    @if ($message = Session::get('messages'))
                        <div class="alert-icon"><i class="flaticon-chat-2 kt-font-brand"></i></div>
                        <div class="alert-text">
                            {{ $message }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label>Địa chỉ email</label>
                <input type="email" name="email" class="form-control" aria-describedby="emailHelp"
                       value="{{ $users_data['email'] }}" placeholder="Nhập địa chỉ email của bạn">
                <span class="form-text text-muted">Nếu bạn thay đổi email. Bạn sẽ nhận được một email xác nhận!</span>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mật khẩu</label>
                <input type="password" name="password" class="form-control" id="InputPassword1"
                       placeholder="Mật khẩu">
                <span class="form-text text-muted">Mật khẩu có độ dài lớn hơn 8 ký tự và nên bao gồm in hoa và in thường</span>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="submit" class="btn btn-primary">Cập nhật hồ sơ</button>
            </div>
        </div>
    </form>


@endsection
