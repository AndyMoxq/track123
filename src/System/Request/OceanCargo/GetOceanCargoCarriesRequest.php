<?php
namespace Track123\OpenApi\System\Request\OceanCargo;
use Track123\OpenApi\Contracts\Request;

class GetOceanCargoCarriesRequest extends Request{
  public const GET_OCEAN_CARGO_CARRIES='/tk/v1/ocean/carrier/list';

  public function __construct(){
    $this -> setApiUri(self::GET_OCEAN_CARGO_CARRIES);
    $this -> setMethod('GET');
  }

  public function validate(){
    //
  }
}