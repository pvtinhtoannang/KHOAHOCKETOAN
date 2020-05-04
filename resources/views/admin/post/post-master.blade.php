@extends('admin.dashboard.dashboard-master')
@section('title', 'Bài viết')
@section('content')
    <h1 class="template-title">Bài viết</h1>
    <ul class="post-status">

        <li @if(Request::route()->status === null) class="active" @endif>
            <a href="{{route('GET_POSTS_ROUTE')}}">Tất cả</a> <span>({{$count['all']}})</span>
        </li>
        @if($count['publish'] !== 0)
            <li @if(Request::route()->status === 'publish') class="active" @endif>
                <a href="{{route('GET_POSTS_ROUTE', 'publish')}}">Đã xuất bản</a> <span>({{$count['publish']}})</span>
            </li>
        @endif
        @if($count['draft'] !== 0)
            <li @if(Request::route()->status === 'draft') class="active" @endif>
                <a href="{{route('GET_POSTS_ROUTE', 'draft')}}">Bản nháp</a> <span>({{$count['draft']}})</span>
            </li>
        @endif
        @if($count['pending'] !== 0)
            <li @if(Request::route()->status === 'pending') class="active" @endif>
                <a href="{{route('GET_POSTS_ROUTE', 'pending')}}">Chờ duyệt</a> <span>({{$count['pending']}})</span>
            </li>
        @endif
        @if($count['trash'] !== 0)
            <li @if(Request::route()->status === 'trash') class="active" @endif>
                <a href="{{route('GET_POSTS_ROUTE', 'trash')}}">Thùng rác</a> <span>({{$count['trash']}})</span>
            </li>
        @endif
    </ul>
    @yield('post_list')
@endsection
