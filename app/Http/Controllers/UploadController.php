<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostMeta;
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

    function getUpload()
    {
        $attachment = $this->post->get_posts($this->post_type);
        return view('admin.uploads.upload', ['attachment' => $attachment]);
    }

    function getUploadNew()
    {
        return view('admin.uploads.upload-new');
    }

    function stripVN($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }

    function fileNameGenerator($path = '', $file_name = '', $base_name = '', $file_extension = '')
    {
        $file_name = str_replace(" ", "-", $file_name);
        $file_path = $path . '/' . $file_name;
        if (!file_exists($file_path)) {
            return $file_name;
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
        $file_name = '';
        foreach ($files as $key => $file) {
            $photo = $files[$key];
            $file_name = $photo->getClientOriginalName();
            $file_extension = $photo->getClientOriginalExtension();
            $file_basename = basename($file_name, '.' . $file_extension);
            $file_name_generator = $this->fileNameGenerator($this->uploads_path, $file_name, $file_basename, $file_extension);
            $photo->move($this->uploads_path, $file_name_generator);
            $post_name = basename($file_name_generator, '.' . $file_extension);
            $post_name = str_replace(" ", "-", $post_name);
            $this->post->createNewPost(
                $user_id,
                '',
                $file_basename,
                '',
                'inherit',
                $post_name,
                $this->post_type
            );
            $get_post = $this->post->get_post_by_post_name($post_name);
            $post_id = $get_post['ID'];
            $metaData = [
                ['post_id' => $post_id, 'meta_key' => 'attached_file', 'meta_value' => $this->year . '/' . $this->month . '/' . $file_name_generator]
            ];
            $this->post_meta->addPostMeta($metaData);
        }
    }
}
