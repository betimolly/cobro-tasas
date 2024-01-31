<div>
    <p class="card-text">Ingrese Captcha</p>
    <div class="form-inline" >
        <div class="input-group" >
            <input id="txtCaptcha" type="text" class="form-control" aria-describedby="captcha" placeholder="Ingrese...">
            @error('imponible') <span class="error">{{ $message }}</span> @enderror
            <img class="img-fluid" src="{{ $captcha }}" alt="Ingrese el captcha">
        </div>
    </div>
</div>
