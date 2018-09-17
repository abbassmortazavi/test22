<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function index()
    {

       // dd(auth()->user()->hasRole(Permission::whereName('edit-article')->first()->roles));

        //return Role::whereName('Admin')->first()->permissions()->sync([1,2]);


        //return auth()->loginUsingId(1);

        //return Role::whereName('Admin')->permissions()->sync([1,2]);

        return view('admin.panel');
    }

    public function uploadImageSubject()
    {

        $this->validate(request() , [
            'upload' => "required|mimes:jpeg,gif,bmp,jpg"
        ]);

        $year = Carbon::now()->year;

        $imagePath = "/images/$year/";
        $file = request()->file('upload');
        $fileName = $file->getClientOriginalName();


        $test = $imagePath . $fileName;

        if (file_exists(public_path($test)))
        {
            $fileName = Carbon::now()->timestamp . $fileName;
        }
        $file->move(public_path($imagePath) , $fileName);

        $url = $imagePath . $fileName;


        return "<script>window.parent.CKEDITOR.tools.callFunction(1 , '{$url}' , 'file uploaded!!!')</script>";
        //return "<script>window.parent.CKEDITOR.tools.callFunction(1 , '{$url}' , '')</script>";

    }
}
