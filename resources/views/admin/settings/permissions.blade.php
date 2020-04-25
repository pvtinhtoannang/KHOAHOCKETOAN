@extends('admin.dashboard.dashboard-master')
@section('title', 'Quản lý truy cập')
@section('content')
    <ul class="nav nav-tabs  nav-tabs-line nav-tabs-line-brand" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tb_tab1" role="tab"><i
                    class="flaticon-cogwheel-1"></i>
                Quản lý truy cập</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tb_tab2" role="tab"><i class="flaticon-layers"></i>
                Quyền truy cập</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tb_tab3" role="tab"><i class="flaticon-user-settings"></i>
                Phân quyền tài khoản</a>
        </li>

    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tb_tab1" role="tabpanel">
            <h1 class="template-title">Quản lý truy cập</h1>

            <form class="kt-form" id="update_permission_for_role" method="POST"
                  action="{{route('UPDATE_PERMISSION_FOR_ROLE')}}">
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
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="role">Chọn loại tài khoản</label>
                                <select name="role" id="role" class="form-control">
                                    @foreach($getAllRole as $key=>$value)
                                        <option value="{{$value->id }}">{{$value->description }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="admin_settings_tp_permissions">Thêm quyền mới</label>
                                <select class="form-control m-select2 admin_settings_tp_permissions"
                                        id="admin_settings_tp_permissions" name="permission_for_role[]"
                                        multiple="multiple">
                                    @foreach($getAllGroup as $value)
                                        <optgroup label="{{ $value->name }}">
                                            @foreach($value->permission as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->display_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8">

                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary btn-elevate">Cập nhật</button>
                        <button type="button" class="reset-permission btn-elevate btn btn-brand"
                                title="Tải lại nếu mọi thứ không thay đổi"><i class="fa fa-undo"></i>Tải lại
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="tb_tab2" role="tabpanel">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <h2 class="template-title">Thêm quyền truy cập mới</h2>
                    <form class="kt-form" method="POST" action="{{route('ADD_PERMISSION_SETTINGS')}}">
                        @csrf
                        <div class="hidden"></div>
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
                            <div class="form-group">
                                <label for="name">Tên quyền truy cập</label>
                                <input id="name" type="text"
                                       name="name" class="form-control"
                                       aria-describedby="name"
                                       value="{{ old('name') }}"
                                       placeholder="Nhập tên, ex: add_post">
                            </div>
                            <div class="form-group">
                                <label for="display_name">Tên hiển thị hoặc mô tả</label>
                                <input id="display_name" type="text"
                                       name="display_name" class="form-control"
                                       aria-describedby="display_name"
                                       value="{{ old('display_name') }}"
                                       placeholder="Nhập tên hiển thị, ex: Thêm mới bài viết">
                            </div>

                            <div class="form-group">
                                <label for="group_id">Nhóm quyền</label>
                                <select name="group_id" class="form-control" id="group_id">
                                    @foreach($getAllGroup as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
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
                        <div class="alert alert-light alert-elevate" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                            <div class="alert-text">
                                Ghi chú: Dưới đây là danh sách các quyền truy cập, xin lưu ý mọi thao tác dưới đây phải
                                được sự cho phép hoặc được thao tác bởi kỹ thuật viên. Mọi phát sinh lỗi nếu truy cập
                                trái phép vào phần này Toàn Năng Cần Thơ không chịu trách nhiệm! Dev Team.
                            </div>
                        </div>
                        <div class="kt-portlet kt-portlet--mobile">
                            <div class="kt-portlet__head kt-portlet__head--lg">
                                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                    <h3 class="kt-portlet__head-title">
                                        Danh sách các quyền truy cập
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

                                <!--begin: Search Form -->
                                <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                    <div class="row align-items-center">
                                        <div class="col-xl-8 order-2 order-xl-1">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                    <div class="kt-input-icon kt-input-icon--left">
                                                        <input type="text" class="form-control"
                                                               placeholder="Tìm kiếm..."
                                                               id="generalSearch">
                                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
															</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                            <a href="#" class="btn btn-default kt-hidden">
                                                <i class="la la-cart-plus"></i> New Order
                                            </a>
                                            <div
                                                class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-hover tnct-table" id="permission">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Mô tả</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getAllPermissionWithPaginate as $key => $value)
                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td class="kt-font-bold">{{$value->name}}
                                                <div class="nowrap row-actions">
                                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                       title="View">
                                                        <i class="la la-eye"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                       class="btn btn-edit-permission btn-sm btn-clean btn-icon btn-icon-md"
                                                       title="Chỉnh sửa" data-toggle="modal" data-id="{{ $value->id }}" data-target="#kt_modal_update_permission_settings">
                                                        <i class="la la-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                       title="View">
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
                        <form class="kt-form" method="POST" action="{{route('UPDATE_PERMISSION_SETTINGS')}}">
                        <div class="modal fade" id="kt_modal_update_permission_settings" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePermission" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cập nhật quyền truy cập</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            @csrf
                                            <div class="hidden"></div>
                                            <div class="kt-portlet__body">

                                                <div class="form-group">
                                                    <label for="update_name">Tên quyền truy cập</label>
                                                    <input id="update_name" type="text"
                                                           name="name" class="form-control"
                                                           aria-describedby="name"
                                                           value=""
                                                           placeholder="Nhập tên, ex: add_post">
                                                </div>
                                                <div class="form-group">
                                                    <label for="update_display_name">Tên hiển thị hoặc mô tả</label>
                                                    <input id="update_display_name" type="text"
                                                           name="display_name" class="form-control"
                                                           aria-describedby="display_name"
                                                           value=""
                                                           placeholder="Nhập tên hiển thị, ex: Thêm mới bài viết">
                                                </div>

                                                <div class="form-group">
                                                    <label for="update_group_id">Nhóm quyền</label>
                                                    <select name="group_id" class="form-control" id="update_group_id">
                                                        @foreach($getAllGroup as $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-primary">Lưu lại</button>
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
        <div class="tab-pane" id="tb_tab3" role="tabpanel">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <h2 class="template-title">Phân quyền tài khoản</h2>
                    <form class="kt-form" method="POST" action="{{route('ADD_OPTION_GENERAL')}}">
                        @csrf
                        <div class="hidden"></div>
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
                            <div class="form-group">
                                <label for="user">Chọn người dùng</label>
                                <select class="form-control " id="user" name="user">
                                    @foreach($getAllUser as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="d-block" for="admin_add_user_permission">Thêm quyền khác</label>
                                <select style="width: 100%" class="form-controlm-select2 admin_settings_tp_permissions"
                                        id="admin_add_user_permission" name="admin_add_user_permission"
                                        multiple="multiple">
                                    @foreach($getAllGroup as $value)
                                        <optgroup label="{{ $value->name  }}">
                                            @foreach($value->permission as $key => $item)
                                                <option selected
                                                        value="{{ $item->name }}">{{ $item->display_name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
