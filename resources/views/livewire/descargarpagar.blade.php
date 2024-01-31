
      <div class="m-2 p-2 border shadow-lg"> <!--w-50 -->
          <p class="card-text lblCard">{{ $impuestolbl }}</p>
          <input id="txtImponible" wire:model="imponible" type="text" class="form-control mb-1" aria-describedby="Imponible" placeholder="Ingrese...">
          @error('imponible') <span class="error">{{ $message }}</span> @enderror

          <div>
              <p class="card-text lblCard">Ingrese Captcha</p>
              <div class="form-inline" >
                  <div class="input-group" >
                      <input id="txtCaptcha" wire:model="captcha" type="text" class="form-control captcha-txt" aria-describedby="captcha" placeholder="Ingrese...">
                      <img class="img-fluid captcha-txt" src="{{ $captchaimg }}" alt="Ingrese el captcha">
                  </div>
              </div>
              @error('captcha') <span class="error">{{ $message }}</span> @enderror
          </div>

          <div class="form-inline m-2 text-center" >
            <a href="#" class="btn btn-success" wire:click="buscar" >Buscar</a>
            <a href="#" class="btn btn-secondary" wire:click="$toggle('showDiv')" >Cancelar</a>
            @if ($showDiv)
              <div id="divData" >
                @if ($records === "") 
                  <table id="tblboleta" class="w-100 mt-3 text-center">
                    <thead>
                      <tr>
                        <th>Cuota</th>
                        <th>Vencimiento</th>
                        <th>Total</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{ $cuota }}</td>
                        <td>{{ $vencimiento }}</td>
                        <td>{{ $total }}</td>
                        <td>
                          <a href="#" class="btn btn-primary" wire:click.prevent ="descargar">Descargar</a>
                          <a href="#" class="btn btn-warning">Pago Fácil</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  @else
                    {{ $records }}
                  @endif
              </div>
            @endif
          </div> 
      </div>
