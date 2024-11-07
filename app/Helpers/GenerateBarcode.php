<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

trait GenerateBarcode
{


    public function GenerateBarcode($text,$type="show", $size=400, $logoPath = null){

              $logoPath = $logoPath === null ?'/public/assets/da2.jpg' : $logoPath; // Use public_path() for accessing the public folder

              // Step 1: Generate QR Code
            // Step 1: Generate QR Code
                $qrCode = QrCode::format('png')
                ->size($size)
                ->backgroundColor(255, 255, 255)
                ->color(0, 0, 0)
                ->errorCorrection('H')
                ->margin(3)
                ->merge( $logoPath, .3)
                ->generate($text);

            //   echo '  <img src="data:image/png;base64,'. base64_encode( $qrCode)  .'" alt="Barcode"> ';
            //   die;
                // Step 2: Create an image from the QR code
                $barcodeImage = Image::make($qrCode);

                // // Step 3: Load and resize the logo
                // $logoSize = 140; // Set logo size smaller than the QR code
                // $logo = Image::make($logoPath)->resize($logoSize, $logoSize, function ($constraint) {
                //     $constraint->aspectRatio(); // Maintain aspect ratio
                //     $constraint->upsize(); // Prevent upsizing
                // });

                // // Step 4: Calculate the center position for the logo
                // $logoX = ($barcodeImage->width() - $logo->width()) / 2;
                // $logoY = ($barcodeImage->height() - $logo->height()) / 2;

                // // Step 5: Insert the logo into the QR code at the calculated position
                // $barcodeImage->insert($logo, 'top-left', $logoX, $logoY);

            // Step 6: Save the final image or return it as a response
            return $barcodeImage->response('png'); // This will output the image directly

    }
}
