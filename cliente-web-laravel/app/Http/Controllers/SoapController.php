<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use SoapClient;

class SoapController extends Controller
{
  /**
   * @var wsdl
   */
  protected $wsdl = 'http://localhost:9080/practica1/services/practica1?wsdl';


  public function validarNIF(Request $request)
  {
    $error = false;
    $nifValid = false;

    $nif = $request->input('nif');
    $soapKey = $request->input('soapKey');

    $client = new SoapClient($this->wsdl, array('exceptions' => 0));
    $response = $client->validarNIF(array('nif' => $nif, 'SoapKey' => $soapKey));

    if (is_soap_fault($response)) {
      $error = $response->faultstring;
    } else {
      $nifValid = $response->isValid;
      if(!$response->isValid) {
        $error = "NIF is not valid";
      }
    }

    return redirect()->back()->with('errorNif', $error)->with('nifValid', $nifValid)->withInput($request->input());
  }



  public function validarIBAN(Request $request)
  {
    $error = false;
    $ibanValid = false;

    $iban = $request->input('iban');
    $soapKey = $request->input('soapKey');

    $client = new SoapClient($this->wsdl, array('exceptions' => 0));

    $response = $client->validarIBAN(array('iban' => $iban, 'SoapKey' => $soapKey));

    if (is_soap_fault($response)) {
      $error = $response->faultstring;
    } else {
      $ibanValid = $response->isValid;
      if(!$response->isValid) {
        $error = $response->error;
      }
    }

    return redirect()->back()->with('errorIban', $error)->with('ibanValid', $ibanValid)->withInput($request->input());
  }

  public function consultarCP(Request $request)
  {
    $error = false;
    $cpPoblacion = false;
    $cpProvincia = false;

    $cp = $request->input('cp');
    $soapKey = $request->input('soapKey');

    $client = new SoapClient($this->wsdl, array('exceptions' => 0));

    $response = $client->consultaCodigoPostal(array('codigoPostal' => $cp, 'SoapKey' => $soapKey));

    if (is_soap_fault($response)) {
      $error = $response->faultstring;
    } else {
      if(!$response->poblacion) {
        $error = "Código Postal no encontrado";
      } else {
        $cpPoblacion = $response->poblacion;
        $cpProvincia = $response->provincia;
      }
    }

    return redirect()->back()->with('errorCp', $error)->with('cp', $cp)->with('cpPoblacion', $cpPoblacion)->with('cpProvincia', $cpProvincia)->withInput($request->input());
  }

  public function generarPresupuesto(Request $request)
  {
    $error = false;
    $cpPoblacion = false;
    $cpProvincia = false;

    $fechaPre = $request->input('fechaPre');
    var_dump($fechaPre);

    $idCliente = $request->input('idCliente');
    $referenciaProd = $request->input('referenciaProd');
    $cantidadProd = $request->input('cantidadProd');
    $soapKey = $request->input('soapKey');

    $client = new SoapClient($this->wsdl, array('exceptions' => 0));

    $response = $client->generarPresupuesto(array(
      'fechaPresupuesto' => $fechaPre,
      'idCliente' => $idCliente,
      'referenciaProducto' => $referenciaProd,
      'cantidadProducto' => $cantidadProd,
      'SoapKey' => $soapKey
    ));

    if (is_soap_fault($response)) {
      $error = $response->faultstring;
    } else {
      if(!$response->presupuestoGeneradoCorrectamente) {
        $error = "Error al generar el presupuesto";
      } else {
        $idPresu = $response->idPresupuesto;
        $presuOK = $response->presupuestoGeneradoCorrectamente;
      }
    }

    return redirect()->back()->with('errorPresu', $error)->with('idPresu', $idPresu)->with('presuOK', $presuOK)->withInput($request->input());
  }
}
