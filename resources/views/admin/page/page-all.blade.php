@extends('admin.dashboard.dashboard-master')
@section('title', 'Trang')
@section('content')
    @inject('term_relationships', 'App\TermRelationships')
    <h1 class="template-title">Trang</h1>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Trang
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{route('GET_POST_NEW_ROUTE')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Thêm trang mới
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
                        <td>{{$post->name}}</td>
                        <?php
                        $created_on = date_create($post->created_on);
                        $updated_at = date_create($post->updated_at);
                        ?>
                        <td>
                            @if($post->post_status == 'publish')
                                Đã xuất bản
                                <br>
                                {{date_format($created_on,"d/m/Y")}}
                            @else
                                Sửa đổi lần cuối
                                <br>
                                {{date_format($updated_at,"d/m/Y")}}
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
