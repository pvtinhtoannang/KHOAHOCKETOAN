@inject('attachment', 'App\Attachment')
<ul class="attachments">
    @if(!empty($attachment->get()))
        @foreach($attachment->get() as $file)
            @if($file->meta['meta_value'] !== null)
                <?php
                $uploads_url = url('/contents/uploads');
                $uploads_path = public_path('/contents/uploads');
                $file_url = $uploads_url . '/' . $file->meta['meta_value'];
                $file_path = $uploads_path . '/' . $file->meta['meta_value'];
                ?>
                @if(file_exists($file_path))
                    <li class="attachment" data-id="{{$file->ID}}" data-src="{{$file_url}}">
                        <div class="attachment-preview">
                            <div class="thumbnail">
                                <img
                                    src="{{$file_url}}"
                                    alt="">
                            </div>
                        </div>
                    </li>
                @endif
            @endif
        @endforeach
    @endif
</ul>
