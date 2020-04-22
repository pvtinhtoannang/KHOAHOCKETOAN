@extends('admin.dashboard.dashboard-master')
@section('title', 'Thư viện')
@section('content')
    @inject('post_meta', 'App\PostMeta')
    <h1 class="template-title">Thư viện</h1>
    <ul class="attachments">
        @if(!empty($attachment))
            @foreach($attachment as $file)
                <?php
                $attachment_meta = $post_meta->get_postmeta_by_meta_key($file->ID, 'attached_file');
                $uploads_url = url('/contents/uploads');
                $file_url = $uploads_url . '/' . $attachment_meta['meta_value'];
                ?>
                <li>
                    <div class="attachment-preview">
                        <div class="thumbnail">
                            <img
                                src="{{$file_url}}"
                                alt="">
                        </div>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
@endsection
