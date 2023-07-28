<?php 
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;


function sluguse($value) {
    return Str::slug($value);
}




function uploadSingleImage(UploadedFile $file,$name,$oldPath=null)
{
    @unlink(public_path($oldPath));
    $filename = $name.'_'.uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('images/'),$filename);
    return $filename;
}

function uploadMultipleImages(array $files,$name,$oldPath=null)
{
    $uploadedImageNames = [];
    foreach ($files as $file) {
        // Validate each file (you can add more validation rules as needed)
        @unlink(public_path($oldPath));
        // Generate a unique filename for each image
        $filename = $name.'_'.uniqid() . '.' . $file->getClientOriginalExtension();
        // Move each image to the specified destination path
        $file->move(public_path('images/'),$filename);
        $uploadedImageNames[] = 'images/'.$filename;
    }
    return $uploadedImageNames;
}