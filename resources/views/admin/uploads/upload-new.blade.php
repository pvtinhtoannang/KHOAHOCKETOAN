@extends('admin.dashboard.dashboard-master')
@section('title', 'Thêm trang mới')
@section('content')
    <h1 class="template-title">Thêm trang mới</h1>
    <div class="form-group row">
        <label class="col-form-label col-lg-3 col-sm-12">Multiple File Upload</label>
        <div class="col-lg-4 col-md-9 col-sm-12">
            <div class="kt-dropzone dropzone m-dropzone--primary" action="inc/api/dropzone/upload.php"
                 id="m-dropzone-two">
                <div class="kt-dropzone__msg dz-message needsclick">
                    <h3 class="kt-dropzone__msg-title">Drop files here or click to upload.</h3>
                    <span class="kt-dropzone__msg-desc">Upload up to 10 files</span>
                </div>
            </div>
        </div>
    </div>
@endsection
