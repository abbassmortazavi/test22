<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    protected function uploadImage($file)
    {
        $year = Carbon::now()->year;
        $imagePath = "images/$year/";
        $fileName = $file->getClientOriginalName();
        $file = $file->move($imagePath , $fileName);

        $sizes = ["300","200","100"];

        $url['images'] = $this->resize($file->getRealPath(),$imagePath,$fileName,$sizes);
        //$url['thumb'] = $url['images'][$sizes[0]];
        $url['thumb'] = $url['images']['original'];
       return $url;
    }

    private function resize($path,$imagePath,$fileName,$sizes)
    {
        $images['original'] = $imagePath . $fileName;
        foreach ($sizes as $size)
        {
            $images[$size] = $imagePath . "$size-" . $fileName;
            Image::make($path)->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($images[$size]);
        }
        return $images;
    }

    protected function setCourseTime($episode)
    {
        $course = $episode->course;
        $course->time = $this->getCourseTime($course->episodes->pluck('time'));
        $course->save();
    }

    protected function getCourseTime($times)
    {
        $timestamp = Carbon::parse('00:00:00');
        foreach ($times as $t)
        {
            $time = strlen($t) == 5 ? strtotime('00' . $t) : strtotime($t);
            $timestamp->addSecond($time);
        }
        return $timestamp->format('H:i:s');
    }
}
