<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function create()
    {

        Storage::disk('user')->put('file.txt', 'This is dummy file for github');
        return true;
    }

    public function autoGitPush()
    {
        $output = shell_exec('git add . && git commit -m "second commit by auto" && git push origin main');
        if ($output) {
            File::delete('file.txt');
            shell_exec('git add .');
            $this->create();
            return 'auto git push successfull';
        } else {
            return 'auto git push failed';
        }
    }
}
