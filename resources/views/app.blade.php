<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pago Municipal</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <style src="../css/main.css"></style>
        <style>
            .header-branding {
                background-color: #f1f6fa;
                border-bottom: 5px solid #99CC33;
            }
            .header-branding a {
                font-size: xx-large;
            }
            .error {
                color: red;
            }
            .card:hover {
                background-color: #506070;
                border-radius: 3px;
                color: #fff;
                -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.2);
                -moz-box-shadow: 0 1px 4px rgba(0,0,0,.2);
                box-shadow: 0 1px 4px rgba(0,0,0,.2);
            }
            .lblCard {
                font-size: 1em;
            }
            /*.card img {
                padding: 5rem!important;
            }*/
            a span{
                display: inline-block;
            }
            @media screen and (max-width: 688px) and (min-width:992px) {
                .header-branding a {
                    font-size: large;
                }
                .card img {
                    padding: 3rem !important;
                }
            }
            @media screen and (max-width: 575px) {
                .header-branding a {
                    font-size: large;
                }
                /*.card img {
                    padding: 3rem !important;
                }*/
                .captcha-txt {
                    width: 50%;
                }
            }
            @media (min-width: 688px) {
                .header-branding a {
                    font-size: large;
                }
                /*.card img {
                    padding: 2rem !important;
                }*/
            }
            /*@media screen and (min-width:992px) {
                .card img {
                    padding: 3rem !important;
                }
            }*/
            /*Tabla de boletas*/
            table#tblboleta { 
                margin: 0 auto;
                border-collapse: collapse;
                /*font-family: Agenda-Light, sans-serif;
                font-weight: 100; 
                text-rendering: optimizeLegibility;*/
                background: /*#333;*/ #6c757d;
                color: #fff;
                border-radius: 5px; 
            }
            table#tblboleta thead th { font-weight: 300; /*600*/}
            table#tblboleta thead th, table#tblboleta tbody td { 
                padding: .8rem; 
                /*font-size: 1.4rem;*/
            }
            table#tblboleta tbody td { 
                padding: .8rem; 
                font-size: 16px; /*1.4rem;*/
                color: #444; 
                background: #eee; 
            }
            table#tblboleta tbody tr:not(:last-child) { 
                border-top: 1px solid #ddd;
                border-bottom: 1px solid #ddd;  
            }
            @media screen and (max-width: 600px) {
                table#tblboleta caption { background-image: none; }
                table#tblboleta thead { display: none; }
                table#tblboleta tbody td { 
                    display: block; 
                    padding: .6rem; 
                }
                table#tblboleta tbody tr td:first-child { 
                    background: #666; color: #fff; 
                }
                    table#tblboleta tbody td:before { 
                    content: attr(data-th); 
                    font-weight: bold;
                    display: inline-block;
                    /*width: 6rem;  */
                }
            }
        </style>   
    </head>
    <body class="antialiased">
        <nav class="navbar bg-body-tertiary header-branding">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="/img/Escudo.png" alt="Municipalidad de Gral. Enrique Godoy" class="img-responsive" height="80">
                    Municipalidad de General Enrique Godoy
                </a>
            </div>
        </nav>
        <div class="container-fluid bg">
            <div class="m-5 text-center">
                <h2>Pague aquí</h2>
            </div>
            <div class="mx-auto col-10 col-md-8 col-lg-6 d-flex justify-content-center">
                <div id="myGroup" class="w-75" >
                    <div class="row text-center">
                        <div class="col-sm-4 mb-3 mb-sm-0 tasas">
                            <a class="btn dropdown" onclick="Livewire.emit('cleanSelf')" data-bs-toggle="collapse" href="#divDataImpT" data-bs-target="#divDataImpT" data-bs-parent="#myGroup" role="button" aria-expanded="false" aria-controls="divDataImpT">
                                <div class="card">
                                    <img class="card-img-top bg-outline-primary img-responsive p-5" src="/img/house-chimney-solid.svg" alt="Pago de tasas municipales">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Inmuebles</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0 tasas">
                            <a class="btn dropdown" onclick="Livewire.emit('cleanSelf')" data-bs-toggle="collapse" href="#divDataImpC" data-bs-target="#divDataImpC" data-bs-parent="#myGroup" role="button" aria-expanded="false" aria-controls="divDataImpC">
                                <div class="card">
                                    <img class="card-img-top bg-outline-warning img-responsive p-5" src="/img/store-solid.svg" alt="Pago de comercio">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Comercios</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0 tasas">
                            <a class="btn dropdown"onclick="Livewire.emit('cleanSelf')" data-bs-toggle="collapse" href="#divDataImpO" data-bs-target="#divDataImpO" data-bs-parent="#myGroup" role="button" aria-expanded="false" aria-controls="divDataImpO">
                                <div class="card">
                                    <img class="card-img-top bg-outline-success img-responsive p-5" src="/img/person-digging-solid.svg" alt="Pago de obras">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">O.Públicas</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">    
                        <div class="accordion-group">
                            <div id="divDataImpT" class="collapse indent" data-bs-parent="#myGroup"> 
                                <livewire:descargarpagar :impuesto="'T'" />
                            </div>
                            <div id="divDataImpC" class="collapse indent" data-bs-parent="#myGroup"> 
                                <livewire:descargarpagar :impuesto="'C'" />
                            </div>
                            <div id="divDataImpO" class="collapse" data-bs-parent="#myGroup"> 
                                <livewire:descargarpagar :impuesto="'O'" />
                            </div>
                            @livewireScripts  
                        </div> 
                    </div> 
                </div>  <!-- mygroup -->              
            </div> 
        </div> <!-- container -->
    </body>
</html>