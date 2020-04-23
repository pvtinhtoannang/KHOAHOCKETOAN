@inject('term_relationships', 'App\TermRelationships')
@inject('post_meta', 'App\PostMeta')
<?php
$post_title = '';
$post_content = '';
$post_name = '';
$excerpt = '';
$cats = array();
$post_status = '';
$file_url = '';
$thumbnail_id = '';
?>
@isset($postData)
    {{--    @dump($postData)--}}
    <?php
    /** @var $postData */
    $post_id = $postData['ID'];
    $post_title = $postData['post_title'];
    $post_content = $postData['post_content'];
    $post_name = $postData['post_name'];
    $excerpt = $postData['post_excerpt'];
    $post_status = $postData['post_status'];
    $terms = $term_relationships->get_term_id_by_object_id($post_id);
    if (!empty($terms)) {
        foreach ($terms as $term) {
            array_push($cats, $term['term_taxonomy_id']);
        }
    }
    $thumbnail_id = $post_meta->get_postmeta_by_meta_key($post_id, 'thumbnail_id');
    $attached_meta = $post_meta->get_postmeta_by_meta_key($thumbnail_id['meta_value'], 'attached_file');
    if (!is_null($attached_meta)) {
        $uploads_url = url('/contents/uploads');
        $file_url = $uploads_url . '/' . $attached_meta['meta_value'];
    }
    ?>
@endisset

<form class="kt-form" id="post" method="post">
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <input type="text" name="post_title" id="post-title" class="form-control" placeholder="Thêm tiêu đề"
                       required value="{{$post_title}}">
            </div>
            <div class="form-group row post-link-row">
                <label for="example-text-input" class="col-form-label">Đường dẫn tĩnh: </label>
                <span class="post-link">{{url('/')}}/</span>
                <div class="col-6">
                    <input class="form-control" type="text" id="post-name" name="post_name" value="{{$post_name}}">
                </div>
            </div>
            <div class="form-group">
                <textarea class="summernote-post-content" id="post_content"
                          name="post_content">{{$post_content}}</textarea>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__head kt-bg-primary">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-font-bolder kt-portlet__head-title kt-font-light">Mô tả ngắn</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <textarea class="form-control" id="excerpt" name="excerpt" rows="4">{{$excerpt}}</textarea>
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
                            <option value="publish" @if($post_status === 'publish') {{'selected'}} @endif>Đã xuất bản
                            </option>
                            <option value="pending" @if($post_status === 'pending') {{'selected'}} @endif>Chờ duyệt
                            </option>
                            <option value="draft" @if($post_status === 'draft') {{'selected'}} @endif>Bản nháp</option>
                        </select>
                    </div>
                </div>
                <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
                    <button class="btn btn-primary" type="submit">
                        @if(!isset($postData))
                            Đăng
                        @else
                            Cập nhật
                        @endif
                    </button>
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
                                @foreach($term_taxonomy->parent_id(0)->category()->get() as $term)
                                    <li>
                                        <label class="kt-checkbox">
                                            <input name="post_category[]" type="checkbox"
                                                   value="{{$term->term_id}}" @if(in_array($term->term_id, $cats)) {{'checked'}} @endif> {{$term->term->name}}
                                            <span></span>
                                        </label>
                                        @include('admin.components.category-children', ['parent' => $term->term_id])
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
                    <div class="featured-image">
                        @if($file_url !== '')
                            <img src="{{$file_url}}"/>
                        @endif
                    </div>
                    <input type="hidden" id="thumbnail_id" name="thumbnail_id">
                </div>
            </div>
        </div>
    </div>
    {{ csrf_field() }}
</form>
