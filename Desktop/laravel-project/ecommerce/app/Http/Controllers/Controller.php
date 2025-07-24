<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $returnUrl;
    public $fileRepo;

    public function prepare($request,$fillables):array
    {
        $data=array();
        foreach ($fillables as $fillable) {
            if ($request->has($fillable)) {
                $data[$fillable] = $request->get($fillable);
            }else {
                if(Str::of($fillable)->startsWith("is_")) {
                    $data[$fillable] = 0;
            }
        }
    }
    if(count($request->allfiles())>0){
        foreach ($request->allfiles() as $key => $value) {
            $uploadedFile = $request->file($key);
            $data[$key] = $uploadedFile->hashName();
            $request->file($key)->storeAs($this->fileRepo, $data[$key]);
        }
    }
    return $data;
    }
}
