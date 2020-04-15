@extends('admin.dashboard.dashboard-master')
@section('title', 'Chuyên mục')
@section('content')
    <h1 class="template-title">Chuyên mục</h1>
    <div class="row">
        <div class="col-md-5">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__body">
                    <h2 class="template-sub-title">Thêm chuyên mục</h2>
                    <form class="kt-form" id="category">
                        <div class="form-group">
                            <label for="category-name">Tên</label>
                            <input type="text" class="form-control" id="category-name" name="category_name">
                            <span class="form-text text-muted">Tên riêng sẽ hiển thị trên trang mạng của bạn.</span>
                        </div>
                        <div class="form-group">
                            <label for="category-slug">Chuỗi cho đường dẫn tĩnh</label>
                            <input type="text" class="form-control" id="category-slug" name="category_slug">
                            <span class="form-text text-muted">Chuỗi cho đường dẫn tĩnh là phiên bản của tên hợp chuẩn với Đường dẫn (URL). Chuỗi này bao gồm chữ cái thường, số và dấu gạch ngang (-).</span>
                        </div>
                        <div class="form-group">
                            <label for="category-parent">Chuyên mục hiện tại</label>
                            <select class="form-control" id="category-parent" name="category_parent">
                                <option>Trống</option>
                                <option>Chuyên mục 1</option>
                                <option>Chuyên mục 2</option>
                                <option>Chuyên mục 3</option>
                                <option>Chuyên mục 4</option>
                            </select>
                            <span class="form-text text-muted">Chuyên mục khác với thẻ, bạn có thể sử dụng nhiều cấp chuyên mục. Ví dụ: Trong chuyên mục nhạc, bạn có chuyên mục con là nhạc Pop, nhạc Jazz. Việc này hoàn toàn là tùy theo ý bạn.</span>
                        </div>
                        <div class="form-group">
                            <label for="category-description">Mô tả</label>
                            <textarea class="form-control" id="category-description" name="category_description" rows="5"></textarea>
                        </div>
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary">Thêm chuyên mục</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <table class="table table-striped table-hover tnct-table" id="posts">
                        <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Chuỗi cho đường dẫn tĩnh</th>
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
                                <td>chuyen-muc</td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>

                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
@endsection
