@extends('admin.dashboard.dashboard-master')
@section('title', 'Bài viết')
@section('content')
    <h1 class="template-title">Bài viết</h1>
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">

            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <a href="{{ route('GET_POST_NEW_ROUTE') }}" class="btn btn-brand btn-icon-sm">
                        <i class="flaticon2-plus"></i> Viết bài mới
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Search Form -->


            <!--end: Search Form -->
        </div>
       
    </div>
@endsection
