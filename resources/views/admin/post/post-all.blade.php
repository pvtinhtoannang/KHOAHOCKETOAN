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
                        <a href="{{route('GET_CREATE_POST_ROUTE')}}" class="btn btn-brand btn-elevate btn-icon-sm">
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
                @foreach($postData as $post)
                    <tr>
                        <td class="kt-font-bold"><a href="">{{$post->post_title}}</a>
                            @if($post->post_status == 'draft')
                                <span class="post-status"> - Bản nháp</span>
                            @elseif($post->post_status == 'pending')
                                <span class="post-status"> - Chờ duyệt</span>
                            @endif
                            <div class="nowrap row-actions">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Xem">
                                    <i class="la la-eye"></i>
                                </a>
                                <a href="{{route('GET_POST_EDIT_ROUTE').'?post='.$post->ID}}"
                                   class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Chỉnh sửa">
                                    <i class="la la-edit"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Bỏ vào thùng rác">
                                    <i class="la la-trash"></i>
                                </a>
                            </div>
                        </td>
                        <td>{{$post->author->name}}</td>
                        <td class="categories">
                            @foreach($post->taxonomies as $cat)
                                @if($cat->taxonomy === 'category')
                                    <a class="" href="">{{$cat->term->name}}</a>
                                @endif
                            @endforeach
                        </td>
                        <td class="tags">
                            @foreach($post->taxonomies as $cat)
                                @if($cat->taxonomy === 'post_tag')
                                    <a class="" href="">{{$cat->term->name}}</a>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if($post->post_status == 'publish')
                                Đã xuất bản
                                <br>
                                {{date_format(date_create($post->created_on),"d/m/Y")}}
                            @else
                                Sửa đổi lần cuối
                                <br>
                                {{date_format(date_create($post->updated_at),"d/m/Y")}}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
@endsection
