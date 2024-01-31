<?php

namespace App\Http\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\Facturacion;
use Exception;
use PDF;
use Picqer\Barcode\BarcodeGeneratorPNG;

class Descargarpagar extends Component
{
    public $impuesto;
    public $impuestolbl;
    public $showDiv = false;
    //public $tasaid = 0;
    public $records;
    public $imponible;
    public $captcha;
    public $captchaimg = '';
    private $impuestonro = [ 'T' => 1, 'O' => 6, 'C' => 2 ];
    public $cuota;
    public $total;
    public $vencimiento;
    public $facturacion;
    

    protected function rules() {
        return [
            'imponible' => 'required|max:15|min:1',
            'captcha' => [ 'required', 'max:6', 'in:' . session("cap_code_user_{ $this->impuesto }") ],
        ];
    }

    protected $messages = [
        'imponible.required' => '* Campo obligatorio',
        'imponible.min' => '* Ingrese al menos 1 caracter',
        'imponible.max' => '* Ingrese como máximo 15 caracteres',
        'captcha.required' => '* Campo obligatorio',
        'captcha.max' => '* Ingrese como máximo 6 caracteres',
        'captcha.in' => '* El captcha no coincide',
    ];

    protected $listeners = [
        "cleanSelf" 
    ];

    public function captchaCalc() {
        ob_start();
        $ranStr = md5(microtime());
        $ranStr = substr($ranStr, 0, 6);
        $nameCaptcha = "cap_code_user_{ $this->impuesto }";
        session([ $nameCaptcha => $ranStr ]);
        $url = Storage::disk('local')->path('public/captcha_bckgrnd.png');
        $newImage = imagecreatefrompng($url);
        $txtColor = imagecolorallocate($newImage, 134, 183, 254);
        
        $font = Storage::disk('local')->path('public/monofont.ttf');
        imagettftext($newImage, 36, 0, 42, 37, $txtColor, $font, $ranStr); 
        //imagestring($newImage, 15, 70, 15, $ranStr, $txtColor);

        imagepng($newImage);
        $imagedata = ob_get_clean();
        $this->captchaimg = "data:image/png;base64,".base64_encode($imagedata);
    }

    public function mount() {
        session([ "cap_code_user_{ $this->impuesto }" => '']);
        $this->captchaCalc();
    }

    public function render() {
        switch ($this->impuesto) {
            case "T" : 
            case "O" : $this->impuestolbl = "Número de Partida"; 
                break;
            case "C" : $this->impuestolbl = "Número de Habilitación";
                break;
        }
        return view('livewire.descargarpagar');
    }

    public function cleanSelf() {
        $this->imponible = '';
        $this->captcha = '';
        $this->showDiv = false;
        //$this->records = '';
    }

    public function buscar() {
        $this->validate();
        $this->callMethod('$toggle', ['showDiv']);
        //$this->records = session("cap_code_user_{ $this->impuesto }");//$this->captcha; //$this->impuesto; //DetalleDeuda::count();
        //$deuda = Deuda::where('nro_enlace', $this->imponible)->where('tipo_t', $this->impuestonro[ $this->impuesto ])->get()->first();
        //$fact = Facturacion::where('nro_imponible', $this->imponible)->where('tipo_imponible', $this->impuestonro[ $this->impuesto ])->get()->first();
        try {
            $this->facturacion = Facturacion::where('nro_imponible', $this->imponible)->where('tipo_imponible', $this->impuestonro[ $this->impuesto ])->firstOrFail();
            $this->records = ""; 
            $this->cuota = $this->facturacion->descripcion; 
            $this->vencimiento = date("d-m-Y", strtotime($this->facturacion->fecha_vencimiento)); 
            $this->total = "$ ".$this->facturacion->total_1; 
        }
        catch(Exception $e) {
            $this->records = "No se encontraron datos";
        }
    }

    public function descargar() { 
        $conceptos = Facturacion::select('concepto','cantidad', 'total_concepto')
            ->where('nro_imponible', $this->imponible)
            ->where('tipo_imponible', $this->impuestonro[ $this->impuesto ])
            ->orderBy('orden')
            ->get();

        $generator = new BarcodeGeneratorPNG();
        $imgBC = $generator->getBarcode($this->facturacion->codigo_barra, $generator::TYPE_CODE_128);
        $data = [
            'title' => 'Municipalidad de General Enrique Godoy',
            'date' => date('d-m-Y'),
            'facturacion' => $this->facturacion,
            'conceptos' => $conceptos,
            'barcode' => "data:image/png;base64,". base64_encode($imgBC)
        ];
           
        $pdf = PDF::loadView('testPDF', $data);
     
        //return $pdf->download('tutsmake.pdf');
        return response()->streamDownload(function () use($pdf) {
            echo  $pdf->stream();
        }, 'boleta_'.date("dmYHis").'.pdf');
    }
}
