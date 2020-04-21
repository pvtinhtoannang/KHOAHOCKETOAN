<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostMeta;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UploadController extends Controller
{
    private $uploads_path, $post, $post_type, $post_name_num, $month, $year, $post_meta;

    public function __construct()
    {
        $this->post = new Post();
        $this->post_type = 'attachment';
        $this->post_name_num = 1;
        $this->month = date('m');
        $this->year = date('Y');
        $this->uploads_path = public_path('/contents/uploads/' . $this->year . '/' . $this->month);
        $this->post_meta = new PostMeta();
    }

    function getUploadNew()
    {
        return view('admin.uploads.upload-new');
    }

    function fileNameGenerator($path = '', $file_name = '', $base_name = '', $file_extension = '')
    {
        $file_name = str_replace(" ", "-", $file_name);
        $file_path = $path . '/' . $file_name;
        if (!file_exists($file_path)) {
            return $fileNam = $file_name;
        } else {
            $new_file_name = $base_name . '-' . $this->post_name_num++ . '.' . $file_extension;
            return $this->fileNameGenerator($path, $new_file_name, $base_name, $file_extension);
        }
    }

    function postUploadNew(Request $request)
    {
        $files = $request->file('file');
        $user_id = Auth::user()->id;

        if (!is_array($files)) {
            $files = [$files];
        }

        if (!is_dir($this->uploads_path)) {
            mkdir($this->uploads_path, 0777, true);
        }

        foreach ($files as $key => $file) {
            $photo = $files[$key];
            $file_name = $photo->getClientOriginalName();
            $file_extension = $photo->getClientOriginalExtension();
            $file_basename = basename($file_name, '.' . $file_extension);
            $file_name_generator = $this->fileNameGenerator($this->uploads_path, $file_name, $file_basename, $file_extension);
            $photo->move($this->uploads_path, $file_name_generator);
            $post_name = basename($file_name_generator, '.' . $file_extension);
            $this->post->createNewPost(
                $user_id,
                '',
                $file_basename,
                '',
                'inherit',
                str_replace(" ", "-", $post_name),
                $this->post_type
            );
            $get_post = $this->post->get_post_by_post_name($post_name);
            $post_id = $get_post['ID'];
            $metaData = [
                ['post_id' => $post_id, 'meta_key' => '_attached_file', 'meta_value' => $this->year . '/' . $this->month . '/' . $file_name_generator]
            ];
            $this->post_meta->addPostMeta($metaData);
        }
    }
}
