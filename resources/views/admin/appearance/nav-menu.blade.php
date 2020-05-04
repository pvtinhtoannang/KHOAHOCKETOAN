@extends('admin.dashboard.dashboard-master')
@section('title', 'Quản lý menu')
@section('content')

    <ul class="nav nav-tabs  nav-tabs-line nav-tabs-line-brand" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#menu_tab_1" role="tab"><i
                    class="flaticon-cogwheel-1"></i>
                Sửa menu</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu_tab_2" role="tab"><i class="flaticon-layers"></i>
                Quản lý vị trí menu</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="menu_tab_1" role="tabpanel">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <h1 class="template-title">Thêm liên kết</h1>
                    <!--begin::Portlet-->
                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Trang
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-group">
                                    <a href="#" data-ktportlet-tool="toggle"
                                       class="btn btn-sm btn-icon btn-clean btn-icon-md"><i
                                            class="la la-angle-down"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the
                                printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                text ever since the 1500s, when an unknown printer took a galley of type and scrambled.
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Trang
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-group">
                                    <a href="#" data-ktportlet-tool="toggle"
                                       class="btn btn-sm btn-icon btn-clean btn-icon-md"><i
                                            class="la la-angle-down"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the
                                printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                text ever since the 1500s, when an unknown printer took a galley of type and scrambled.
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Trang
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-group">
                                    <a href="#" data-ktportlet-tool="toggle"
                                       class="btn btn-sm btn-icon btn-clean btn-icon-md"><i
                                            class="la la-angle-down"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the
                                printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                text ever since the 1500s, when an unknown printer took a galley of type and scrambled.
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Trang
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-group">
                                    <a href="#" data-ktportlet-tool="toggle"
                                       class="btn btn-sm btn-icon btn-clean btn-icon-md"><i
                                            class="la la-angle-down"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled. Lorem Ipsum is simply dummy text of the
                                printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                text ever since the 1500s, when an unknown printer took a galley of type and scrambled.
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
                <div class="col-xs-12 col-md-9">
                    <h1 class="template-title">Cấu trúc menu</h1>
                </div>
            </div>
        </div>
        <div class="tab-pane active" id="menu_tab_2" role="tabpanel">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <h2 class="template-title">Thêm vị trí mới</h2>
                    <form class="kt-form" method="POST" action="{{route('POST_ADD_NEW_MENU_POSITION')}}">
                        @csrf
                        <div class="hidden"></div>
                        <div class="kt-portlet__body">
                            <div class="form-group form-group-last">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if ($message = Session::get('messages'))
                                    <div class="alert alert-secondary" role="alert">
                                        <div class="alert-icon"><i class="flaticon-chat-2 kt-font-brand"></i></div>
                                        <div class="alert-text">
                                            {{ $message }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Nhãn</label>
                                <input id="name" type="text"
                                       name="name" class="form-control"
                                       aria-describedby="name"
                                       value="{{ old('name') }}"
                                       placeholder="Nhập tên, hông có được viết dấu, ex: primary_menu, primary-menu">
                            </div>
                            <div class="form-group">
                                <label for="display_name">Tên hiển thị</label>
                                <input id="display_name" type="text"
                                       name="display_name" class="form-control"
                                       aria-describedby="display_name"
                                       value="{{ old('display_name') }}"
                                       placeholder="Nhập tên, viết dấu cho dễ đọc, ex: Menu chính">
                            </div>

                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-md-8">

                    <!-- begin:: Content -->
                    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

                        <div class="kt-portlet kt-portlet--mobile">
                            <div class="kt-portlet__head kt-portlet__head--lg">
                                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                    <h3 class="kt-portlet__head-title">
                                        Danh sách menu
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <div class="kt-portlet__head-wrapper">
                                        <a href="javascript:history.go(-1)" class="btn btn-clean btn-icon-sm">
                                            <i class="la la-long-arrow-left"></i>
                                            Trở lại trang trước
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body">

                                <table class="table table-striped table-hover tnct-table" id="permission">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nhãn</th>
                                        <th>Tên hiển thị</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($position_menu as $key => $value)
                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td class="kt-font-bold">{{$value->name}}
                                                <div class="nowrap row-actions">
                                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                       title="View">
                                                        <i class="la la-eye"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                       class="btn btn-edit-user btn-sm btn-clean btn-icon btn-icon-md"
                                                       title="Chỉnh sửa" data-toggle="modal" data-id="{{ $value->id }}"
                                                       data-target="#kt_modal_update_users">
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                    <a href="#"
                                                       class="btn btn-sm btn-clean btn-icon btn-icon-md kt_sweetalert_delete_permission"
                                                       title="Xoá">
                                                        <i class="la la-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{$value->display_name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--begin::Modal-->
                        <form class="kt-form" method="POST" action="{{route('UPDATE_USER_BY_LIST')}}">
                            <div class="modal fade" id="kt_modal_update_users" tabindex="-1" role="dialog"
                                 aria-labelledby="modalUpdatePermission" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateUserLabelHeading">Cập nhật thành viên</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @csrf
                                            <div class="hidden"></div>
                                            <div class="kt-portlet__body">
                                                <input type="hidden" id="update_id" value="" name="update_id">
                                                <div class="form-group">
                                                    <label for="update_name">Họ và tên</label>
                                                    <input id="update_name" type="text"
                                                           name="name" class="form-control"
                                                           aria-describedby="name"
                                                           value=""
                                                           placeholder="Nhập họ và tên, ex: nguyen van a">
                                                </div>
                                                <div class="form-group">
                                                    <label for="update_email">Email</label>
                                                    <input id="update_email" type="email"
                                                           name="email" class="form-control"
                                                           aria-describedby="email"
                                                           value=""
                                                           placeholder="Nhập email, ex: nguyenvana@gmail.com">
                                                </div>
                                                <div class="form-group">
                                                    <label for="update_password">Mật khẩu: (để trống nếu không cập
                                                        nhật)</label>
                                                    <input id="update_password" type="password"
                                                           name="password" class="form-control"
                                                           aria-describedby="email"
                                                           value=""
                                                           placeholder="Nhập email, ex: nguyenvana@gmail.com">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" value="" id="update_id" name="id">
                                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Đóng
                                            </button>
                                            <button type="submit" class="btn btn-primary">Lưu lại</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--end::Modal-->
                    </div>
                    <!-- end:: Content -->
                </div>
            </div>
        </div>
    </div>


@endsection
