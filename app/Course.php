<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Post
{
    /**
     * @var string
     */
    protected $postType = 'course';
}
