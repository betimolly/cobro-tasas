<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Captcha extends Component
{
    public $captcha = '';

    public function captchaCalc() {
        ob_start();
        $ranStr = md5(microtime());
        $ranStr = substr($ranStr, 0, 6);
        $_SESSION['cap_code_user'] = $ranStr;
        $url = Storage::disk('local')->path('public/captcha_bckgrnd.png');
        $newImage = imagecreatefrompng($url);
        $txtColor = imagecolorallocate($newImage, 255, 255, 255);
        imagestring($newImage, 15, 70, 15, $ranStr, $txtColor);
        //$font = '/fonts/arial.ttf';
        //imagettftext($newImage, 36, 0, 10, 20, $txtColor, $font, $ranStr);
        imagepng($newImage);
        $imagedata = ob_get_clean();
        $this->captcha = "data:image/png;base64,".base64_encode($imagedata);
    }

    public function render()
    {
        $this->captchaCalc();
        return view('livewire.captcha');
    }
}
