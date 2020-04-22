@inject('post_meta', 'App\PostMeta')
@inject('post', 'App\Post')
<?php
$attachment = $post->get_posts('attachment');
?>
<ul class="attachments">
    @if(!empty($attachment))
        @foreach($attachment as $file)
            <?php
            $attachment_meta = $post_meta->get_postmeta_by_meta_key($file->ID, '_attached_file');
            $uploads_url = url('/contents/uploads');
            $file_url = $uploads_url . '/' . $attachment_meta['meta_value'];
            ?>
            <li class="attachment" aria-checked="false" aria-label="{{$file->post_name}}" data-id="{{$file->ID}}">
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
