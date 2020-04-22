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
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tb_tab1" role="tabpanel">
            <h1 class="template-title">Quản lý truy cập</h1>

            <form class="kt-form" method="POST" action="{{route('POST_OPTION_GENERAL')}}">
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
                            <div class="form-group">
                                <label for="role">Chọn loại tài khoản</label>
                                <select name="role" id="role" class="form-control">
                                    @foreach($getAllRole as $key=>$value)
                                        <option value="{{$value->name }}">{{$value->description }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="admin_settings_tp_permissions">Thêm quyền mới</label>
                                <select class="form-control m-select2 " id="admin_settings_tp_permissions" name="param" multiple="multiple">
                                    <optgroup label="A6 laskan/Hawaiian Time Zone">
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">

                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane" id="tb_tab2" role="tabpanel">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <h2 class="template-title">Thêm quyền truy cập mới</h2>
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

                                <!--end: Search Form -->

                                <!--begin::Section-->
                                <!--begin: Datatable -->

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
                                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                       title="View">
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

                                <!--end: Datatable -->
                                <!--end::Section-->
                            </div>

                        </div>
                    </div>

                    <!-- end:: Content -->
                </div>
            </div>
        </div>
    </div>

@endsection
