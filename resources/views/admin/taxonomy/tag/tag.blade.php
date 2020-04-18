@extends('admin.dashboard.dashboard-master')
@section('title', 'Thẻ')
@section('content')
    <h1 class="template-title">Thẻ</h1>
    <div class="row">
        <div class="col-md-5">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__body">
                    <h2 class="template-sub-title">Thêm thẻ</h2>
                    <form class="kt-form" id="tag" method="post">
                        <div class="form-group">
                            <label for="tag-name">Tên</label>
                            <input type="text" class="form-control" id="tag-name" name="tag_name" required>
                            <span class="form-text text-muted">Tên riêng sẽ hiển thị trên trang mạng của bạn.</span>
                        </div>
                        <div class="form-group">
                            <label for="tag-slug">Chuỗi cho đường dẫn tĩnh</label>
                            <input type="text" class="form-control" id="tag-slug" name="tag_slug" required>
                            <span class="form-text text-muted">Chuỗi cho đường dẫn tĩnh là phiên bản của tên hợp chuẩn với Đường dẫn (URL). Chuỗi này bao gồm chữ cái thường, số và dấu gạch ngang (-).</span>
                        </div>
                        <div class="form-group">
                            <label for="tag-description">Mô tả</label>
                            <textarea class="form-control" id="tag-description" name="tag_description"
                                      rows="5"></textarea>
                        </div>
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary">Thêm thẻ</button>
                        </div>
                        {{ csrf_field() }}
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
                            <th>Mô tả</th>
                            <th>Chuỗi cho đường dẫn tĩnh</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tagData as $tagValue)
                            <tr>
                                <td class="kt-font-bold">{{$tagValue['name']}}
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
                                <td>
                                    @if($tagValue['description'] == '')
                                        {{'Không có mô tả'}}
                                    @else
                                        {{$tagValue['description']}}
                                    @endif
                                </td>
                                <td>{{$tagValue['slug']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
@endsection