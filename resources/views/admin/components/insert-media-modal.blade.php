<div class="modal fade insert-media-modal media-modal" id="insert-media-modal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Thêm Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-success nav-tabs-line-2x" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#item-upload-insert" role="tab">
                            <i class="la la-cloud-upload"></i> Tải tập tin lên
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="browse-btn" data-toggle="tab" href="#item-browse-insert" role="tab">
                            <i class="la la-camera-retro"></i> Thư viện
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane" id="item-upload-insert" role="tabpanel">
                        @include('admin.components.upload-new')
                    </div>
                    <div class="tab-pane active" id="item-browse-insert" role="tabpanel">
                        @include('admin.components.upload')
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="media-button-select" class="btn btn-primary media-button-select" disabled="disabled">Chèn vào bài viết</button>
            </div>
        </div>
    </div>
</div>
