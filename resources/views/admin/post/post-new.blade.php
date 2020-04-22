@extends('admin.dashboard.dashboard-master')
@section('title', 'Thêm bài viết')
@section('content')
    @inject('term_taxonomy', 'App\TermTaxonomy')
    <h1 class="template-title">Thêm bài viết</h1>
    <form class="kt-form" id="post" method="post">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <input type="text" name="post_title" id="post-title" class="form-control" placeholder="Thêm tiêu đề"
                           required>
                </div>
                <div class="form-group row post-link-row">
                    <label for="example-text-input" class="col-form-label">Đường dẫn tĩnh: </label>
                    <span class="post-link">{{url('/')}}/</span>
                    <div class="col-6">
                        <input class="form-control" type="text" id="post-name" name="post_name">
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="summernote-post-content" id="post_content" name="post_content"></textarea>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-bg-primary">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Mô tả ngắn</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="4"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-bg-primary">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Đăng</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label for="post-status">Trạng thái</label>
                            <select class="form-control" id="post-status" name="post_status">
                                <option value="publish" selected>Đã xuất bản</option>
                                <option value="pending">Chờ duyệt</option>
                                <option value="draft">Bản nháp</option>
                            </select>
                        </div>
                    </div>
                    <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
                        <button class="btn btn-primary" type="submit">Đăng</button>
                    </div>
                </div>

                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-bg-primary">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Chuyên mục</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-checkbox-list">
                            <div id="category-list">
                                <ul class="categorychecklist">
                                    @foreach($term_taxonomy->get_term_by_parent(0, 'category') as $categoryValue)
                                        <li>
                                            <label class="kt-checkbox">
                                                <input name="post_category[]" type="checkbox"
                                                       value="{{$categoryValue['term_id']}}"> {{$categoryValue['name']}}
                                                <span></span>
                                            </label>
                                            @include('admin.components.category-children', ['parent' => $categoryValue['term_id']])
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-bg-primary">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Thẻ</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div id="post-tag-repeater">
                            <div class="form-group">
                                <div data-repeater-list="">
                                    <div data-repeater-item class="form-group row align-items-center">
                                        <div class="col-md-10">
                                            <input type="text" name="group[][post_tag]" class="form-control"
                                                   placeholder="Thêm thẻ">
                                        </div>
                                        <div class="col-md-2">
                                            <div data-repeater-delete=""
                                                 class="btn btn-danger btn-elevate btn-circle btn-icon">
																	<span>
																		<i class="la la-trash-o"></i>
																	</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div data-repeater-create="" class="btn btn btn-sm btn-brand btn-pill">
															<span>
																<i class="la la-plus"></i>
																<span>Thêm</span>
															</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__head kt-portlet__head--noborder kt-bg-primary">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Ảnh đại diện</h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-actions">
                                <a href="#" data-toggle="modal" data-target="#featured-image-modal"
                                        class="btn btn-outline-light btn-sm btn-icon btn-icon-md">
                                    <i class="flaticon2-add-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="featured-image"></div>
                        <input type="hidden" id="thumbnail_id" name="thumbnail_id">
                    </div>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
    </form>
    @include('admin.components.featured-image-modal')
@endsection
