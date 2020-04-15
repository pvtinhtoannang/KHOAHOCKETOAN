@extends('admin.dashboard.dashboard-master')
@section('title', 'Bài viết')
@section('content')
    <h1 class="template-title">Bài viết</h1>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Bài viết
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="#" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Viết bài mới
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped table-hover tnct-table" id="posts">
                <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Chuyên mục</th>
                    <th>Thẻ</th>
                    <th>Thời gian</th>
                </tr>
                </thead>
                <tbody>
                @for($i = 0; $i <= 10; $i++)
                    <tr>
                        <td class="kt-font-bold">Tiêu đề bài viết
                            <div class="nowrap row-actions">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                    <i class="la la-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                    <i class="la la-edit"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                    <i class="la la-trash"></i>
                                </a>
                            </div>
                        </td>
                        <td>Tác giả</td>
                        <td>Chuyên mục</td>
                        <td>Thẻ</td>
                        <td>2/12/2018</td>
                    </tr>
                @endfor
                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
@endsection
