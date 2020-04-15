@extends('admin.dashboard.dashboard-master')
@section('title', 'Thêm bài viết')
@section('content')
    <h1 class="template-title">Thêm bài viết</h1>
    <form class="kt-form" id="post">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" name="post_title" id="title" class="form-control" placeholder="Thêm tiêu đề">
                </div>
                <div class="form-group">
                    <textarea class="wysiwyg-editor" id="mytextarea" name="mytextarea"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-bg-success">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Đăng</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
                        <a href="#" class="btn btn-success">Đăng</a>
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-bg-success">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Chuyên mục</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-checkbox-list">
                            <label class="kt-checkbox">
                                <input type="checkbox"> Chuyên mục 1
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox"> Chuyên mục 2
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox"> Chuyên mục 3
                                <span></span>
                            </label>
                            <label class="kt-checkbox">
                                <input type="checkbox"> Chuyên mục 4
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-bg-success">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Thẻ</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-portlet__head--noborder kt-bg-success">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Ảnh đại diện</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-actions">
                                <a href="#" class="btn btn-outline-light btn-sm btn-icon btn-icon-md">
                                    <i class="flaticon2-add-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
