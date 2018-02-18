<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                width: 60%;
                margin: 10px auto;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 42px;
                margin-top: 30px;
            }

            .links-a {
              flex-grow: 1;
              height: 30px;
              display: block;
              background-color: #00bcd470;
              border-width: 1px;
              border-radius: 6px;
              color: #fff;
              padding: 0 25px;
              font-size: 12px;
              font-weight: 600;
              letter-spacing: .1rem;
              text-decoration: none;
              text-transform: uppercase;
              align-items: center;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .section-form {
                margin: 25px 15px;
            }

            .panel {
                margin-top: 10px;
                margin-bottom: 20px;
                background-color: #fff;
                border: 1px solid transparent;
                border-radius: 4px;
                -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
                box-shadow: 0 1px 1px rgba(0,0,0,.05);
            }
            .panel > .panel-heading {
              font-weight: bold;
              font-size: 12px;
            }

            .panel-danger {
                border-color: #ebccd1;
            }
            .panel-danger>.panel-heading {
              color: #a94442;
              background-color: #f2dede;
              border-color: #ebccd1;
            }

            .panel-success {
                border-color: #d6e9c6;
            }

            .panel-success>.panel-heading {
                color: #3c763d;
                background-color: #dff0d8;
                border-color: #d6e9c6;
            }

            .panel-heading {
                padding: 10px 15px;
                border-bottom: 1px solid transparent;
                border-top-left-radius: 3px;
                border-top-right-radius: 3px;
            }

            .panel-body {
              padding: 10px;
              font-size: 13px;
              font-weight: 600;
            }


            .operations {
                display: flex;
                align-content: left;
                width:30%;
            }

            .operations > p {
              font-weight: 600;
            }

            .operations-forms {
                display: flex;
                align-content: right;
                width: 70%;
                padding: 12px 4px;
            }

            .div-form {
                display: inline-flex;
                width: 100%;
            }

            .input-grow {
              flex-grow: 1;
            }

            .operations-forms > input {
              display: block;
              width: 100%;
              padding: 6px 12px;
              font-size: 14px;
              line-height: 1.42857143;
              color: #555;
              background-color: #fff;
              background-image: none;
              border: 1px solid #ccc;
              border-radius: 4px;
              -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
              box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
              -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
              -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
              transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
          }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    MTIS - Práctica 1
                </div>

                <div class="m-b-md">
                    Cliente Web en Laravel <small>- powered by <b>Arancha Ferrero</b> -</small>
                </div>

                <hr/>

                <div class="links">
                  <!-- NIF Validation -->
                  <div class="section-form">
                    <form action="{{ action('SoapController@validarNIF') }}" method="POST">
                      {{ csrf_field() }}
                      <div class="div-form">
                        <div class="operations">
                          <p>Soap Key</p>
                        </div>
                        <div class="operations-forms">
                          <input type="text" name="soapKey" id="soapKey" class="input-grow"  value="{{ old('soapKey') }}"/>
                        </div>
                      </div>
                      <div class="div-form">
                        <div class="operations">
                          <p>NIF</p>
                        </div>
                        <div class="operations-forms">
                          <input type="text" name="nif" id="nif" class="input-grow"  value="{{ old('nif') }}"/>

                        </div>
                      </div>
                      <div class="div-form">
                        <button type="submit" class="links-a">Validar</button>
                      </div>
                    </form>
                    @if (session('nifValid'))
                       <div class="panel panel-success">
                           <div class="panel-heading"> Yep! It's Valid</div>
                       </div>
                    @endif
                    {{-- Error messages --}}
                    @if (session('errorNif'))
                       <div class="panel panel-danger">
                           <div class="panel-heading">ERROR! {{ session('errorNif') }}</div>
                       </div>
                    @endif
                  </div>
                  <!-- end NIF Validation -->

                  <hr/>

                  <!-- IBAN Validation -->
                  <div class="section-form">
                    <form action="{{ action('SoapController@validarIBAN') }}" method="POST">
                      {{ csrf_field() }}
                      <div class="div-form">
                        <div class="operations">
                          <p>Soap Key</p>
                        </div>
                        <div class="operations-forms">
                          <input type="text" name="soapKey" id="soapKey" class="input-grow" value="{{ old('soapKey') }}"/>
                        </div>
                      </div>
                      <div class="div-form">
                        <div class="operations">
                          <p>IBAN</p>
                        </div>
                        <div class="operations-forms">
                          <input type="text" name="iban" id="iban" class="input-grow" value="{{ old('iban') }}"/>
                        </div>
                      </div>
                      <div class="div-form">
                        <button type="submit" class="links-a">Validar</button>
                      </div>
                    </form>
                    @if (session('ibanValid'))
                       <div class="panel panel-success">
                           <div class="panel-heading"> Yep! It's Valid</div>
                       </div>
                    @endif
                    {{-- Error messages --}}
                    @if (session('errorIban'))
                       <div class="panel panel-danger">
                           <div class="panel-heading">ERROR! {{ session('errorIban') }}</div>
                       </div>
                    @endif
                  </div>
                  <!-- end IBAN Validation -->

                  <hr/>

                  <!-- CP -->
                  <div class="section-form">
                    <form action="{{ action('SoapController@consultarCP') }}" method="POST">
                      {{ csrf_field() }}
                      <div class="div-form">
                        <div class="operations">
                          <p>Soap Key</p>
                        </div>
                        <div class="operations-forms">
                          <input type="text" name="soapKey" id="soapKey" class="input-grow" value="{{ old('soapKey') }}"/>
                        </div>
                      </div>
                      <div class="div-form">
                        <div class="operations">
                          <p>Código Postal</p>
                        </div>
                        <div class="operations-forms">
                          <input type="text" name="cp" id="cp" class="input-grow" value="{{ old('cp') }}"/>
                        </div>
                      </div>
                      <div class="div-form">
                        <button type="submit" class="links-a">Consultar</button>
                      </div>
                    </form>
                    @if (session('cpPoblacion'))
                       <div class="panel panel-success">
                           <div class="panel-body">
                             <p>
                               CP: {{ session('cp') }}
                             </p>
                             <p>
                               Población: {{ session('cpPoblacion') }}
                             </p>
                             <p>
                               Provincia: {{ session('cpProvincia') }}
                             </p>
                           </div>
                       </div>
                    @endif
                    {{-- Error messages --}}
                    @if (session('errorCp'))
                       <div class="panel panel-danger">
                           <div class="panel-heading">ERROR! {{ session('errorCp') }}</div>
                       </div>
                    @endif
                  </div>
                  <!-- end CP -->

                  <hr/>

                  <!-- PRESUPUESTO -->
                  <div class="section-form">
                    <form action="{{ action('SoapController@generarPresupuesto') }}" method="POST">
                      {{ csrf_field() }}
                      <div class="div-form">
                        <div class="operations">
                          <p>Soap Key</p>
                        </div>
                        <div class="operations-forms">
                          <input type="text" name="soapKey" id="soapKey" class="input-grow" value="{{ old('soapKey') }}"/>
                        </div>
                      </div>
                      <div class="div-form">
                        <div class="operations">
                          <p>Fecha Presupuesto</p>
                        </div>
                        <div class="operations-forms">
                          {!! Form::date('fechaPre', \Carbon\Carbon::now()->format('D/M/Y'), ['class' => 'input-grow', 'required' => true, 'id' => 'fechaPre']) !!}
                          <!-- <input type="date" name="fechaPre" id="fechaPre" class="input-grow"/> -->
                        </div>
                      </div>
                      <div class="div-form">
                        <div class="operations">
                          <p>ID Cliente</p>
                        </div>
                        <div class="operations-forms">
                          <input type="text" name="idCliente" id="idCliente" class="input-grow" value="{{ old('idCliente') }}"/>
                        </div>
                      </div>
                      <div class="div-form">
                        <div class="operations">
                          <p>Referencia Producto</p>
                        </div>
                        <div class="operations-forms">
                          <input type="text" name="referenciaProd" id="referenciaProd" class="input-grow" value="{{ old('referenciaProd') }}"/>
                        </div>
                      </div>
                      <div class="div-form">
                        <div class="operations">
                          <p>Candidad Producto</p>
                        </div>
                        <div class="operations-forms">
                          <input type="text" name="cantidadProd" id="cantidadProd" class="input-grow" value="{{ old('cantidadProd') }}"/>
                        </div>
                      </div>
                      <div class="div-form">
                        <button type="submit" class="links-a">Generar</button>
                      </div>
                    </form>
                    @if (session('presuOK'))
                       <div class="panel panel-success">
                           <div class="panel-body">
                             <p>
                               ID Presupuesto: {{ session('idPresu') }}
                             </p>
                             <p>
                               Presupuesto Generado Correctamente: {{ session('presuOK') }}
                             </p>
                           </div>
                       </div>
                    @endif
                    {{-- Error messages --}}
                    @if (session('errorPresu'))
                       <div class="panel panel-danger">
                           <div class="panel-heading">ERROR! {{ session('errorPresu') }}</div>
                       </div>
                    @endif
                  </div>
                  <!-- end PRESUPUESTO -->
                </div>
            </div>
        </div>
    </body>
</html>
