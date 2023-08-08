<?php 
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

function sluguse($value) {
    return Str::slug($value);
}



function uploadSingleImage(UploadedFile $file,$name,$oldPath=null)
{
    @unlink(public_path($oldPath));
    $filename = $name.'_'.uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('images/'.$name.'/'),$filename);
    return 'images/'.$name.'/'.$filename;
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
        $file->move(public_path('images/'.$name.'/'),$filename);
        $uploadedImageNames[] = 'images/'.$name.'/'.$filename;
    }
    return $uploadedImageNames;
}


function smsPost($num,$msg) 
{
    $url = 'https://softmaxshop.com/api/admin/sms/host';
    $response = Http::get($url);
    if ($response->successful()) {
        $data = $response->json();
        $api_key = $data['sms_api_key'];
        $from = $data['sms_api_from'];
        $url = $data['sms_api_url'];
        $data = [
            'api_key' => "$api_key",
            'from' => "$from",
            'to' => "88$num",
            'sms' => "$msg",
            'unicode' => '1',
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        return $api_key;
    } else {
        return null;
    }
}

