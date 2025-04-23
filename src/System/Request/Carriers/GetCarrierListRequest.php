<?php

namespace Track123\OpenApi\System\Request\Carriers;
use Track123\OpenApi\Contracts\Request;

class GetCarrierListRequest extends Request {

  public const URI='/tk/v2/courier/list';
  public function __construct(){
    $this -> setApiUri(self::URI);
    $this -> setMethod('GET');
  }
  public function rules():array{
    return [];
  }

  public function validate(){
  }
}