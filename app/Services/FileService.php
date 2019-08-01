<?php

namespace App\Services;


use App\Models\BlogPost;

class FileService
{
    public function upload_file($upload_file,$data)
    {
        if ($upload_file) {
            $data['file']=$upload_file->store('blog_uploads', 'public');
        }
        return BlogPost::create($data);
    }
}
