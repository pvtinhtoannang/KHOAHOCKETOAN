@extends('admin.dashboard.dashboard-master')
@section('title', 'Chỉnh sửa bài viết')
@section('content')
    <h1 class="template-title">Chỉnh sửa trang</h1>
    @include('admin.components.post-editor')
    @include('admin.components.featured-image-modal')
@endsection
