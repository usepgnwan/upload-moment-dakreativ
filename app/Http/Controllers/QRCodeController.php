<?php

namespace App\Http\Controllers;

use App\Helpers\GenerateBarcode;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    use GenerateBarcode;
    public function __invoke($url)
    {
        if($url ==null){
            abort(404);
        }
        $host = config('app.url'); // Gets the base URL from the config
        $fullUrl = $host . '/' . ltrim($url, '/'); // Ensure proper URL formatting
        return $this->GenerateBarcode($fullUrl, 'generate');
    }
}
