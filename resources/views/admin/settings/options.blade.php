@extends('admin.dashboard.dashboard-master')
@section('title', 'Cài đặt tổng quan')
@section('content')
    <h1 class="template-title">Tuỳ chọn tổng quan</h1>
    <form class="kt-form" method="POST" action="{{route('POST_MY_PROFILE')}}">
        @csrf
        <div class="kt-portlet__body">
            <div class="form-group form-group-last">
                @if ($message = Session::get('messages'))
                    <div class="alert alert-secondary" role="alert">
                        <div class="alert-icon"><i class="flaticon-chat-2 kt-font-brand"></i></div>
                        <div class="alert-text">
                            {{ $message }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    @foreach($options as $option)
                        <div class="form-group">
                            <label>{{ $option['option_label'] }}</label>
                            @if($option['option_type']=='text' || $option['option_type']=='url' || $option['option_type']=='email' || $option['option_type']=='number')
                                <input type="text" name="{{ $option['option_name'] }}" class="form-control"
                                       aria-describedby="{{ $option['option_name'] }}"
                                       value="{{ $option['option_value'] }}"
                                       placeholder="Nhập {{  $option['option_label'] }}">
                            @elseif ($option['option_type']=='textarea')
                                <textarea name="{{ $option['option_name'] }}" id="{{ $option['option_name'] }}"
                                          cols="30" rows="10" class="form-control"></textarea>
                            @else

                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="submit" class="btn btn-primary">Cập nhật hồ sơ</button>
            </div>
        </div>
    </form>


@endsection
