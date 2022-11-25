<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function updateprofile(Request $request, $file)
    {
        $p = $request->input();
        $path = '';

        if ($request->file($file)) {
            $request->validate([
                $file => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imagePath = $request->file($file);
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file($file)->storeAs('public/profileimage', time() . $imageName);
            $path = str_replace('public/', '', $path);
            $path=url('/').'/storage'.'/'.$path;
        }
        return $path;
    }


    public function saveThumbnailImage(Request $request, $file)
    {

        $path = '';

        if ($file) {
            // $request->validate([
            //     $file => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            $imagePath = $file;
            $imageName = $imagePath->getClientOriginalName();
            $path = $file->storeAs('public/thumbnailimage', time() . $imageName);
            $path = str_replace('public/', '', $path);
            $path=url('/').'/storage'.'/'.$path;
        }
        return $path;
    }

    public function saveCheckInAnswerImage(Request $request, $file)
    {

        $path = '';

        if ($file) {
            // $request->validate([
            //     $file => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            $imagePath = $file;
            $imageName = $imagePath->getClientOriginalName();
            $path = $file->storeAs('public/checkinquestionimage', time() . $imageName);
            $path = str_replace('public/', '', $path);
            $path=url('/').'/storage'.'/'.$path;
        }
        return $path;
    }


}
