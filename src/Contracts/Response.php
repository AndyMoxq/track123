<?php
namespace Track123\OpenApi\Contracts;

use Track123\OpenApi\Exception\ValidateResponseException;

class Response
{
    /**
     * @var array
     */
    protected $body = [
        'code' => 0,
        'message' => '',
        'data' => null
    ];

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->body['code'] ?? 0;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->body['code'] = $code;
        return $this;
    }

    /**
     * @return mixed|string
     */
    public function getMessage()
    {
        return $this->body['msg'] ?? '';
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->body['msg'] = $message;
        return $this;
    }

    /**
     * @return array|mixed
     */
    public function getData()
    {
        return $this->body['data'] ?? [];
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->body['data'] = $data;
        return $this;
    }

    /**
     * @param $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * 获取已接受的数据
     *
     * @return array
     */
    public function getAcceptedData(): array {
        return $this->getData()['accepted'] ?? [];
    }

    /**
     * 获取被拒绝的数据
     *
     * @return array
     */
    public function getRejectedData(): array {
        return $this->getData()['rejected'] ?? [];
    }

    /**
     * 是否存在被拒绝的数据
     *
     * @return bool
     */
    public function hasRejectedData(): bool {
        return !empty($this->getRejectedData());
    }

    /**
     * @param array $responseBody
     * @return $this
     */
    public static function format(array $responseBody = [])
    {
        $response = new static();
        $response->setBody($responseBody);
        $response->validate();
        return $response;
    }

    /**
     * @throws ValidateResponseException
     */
    public function validate()
    {
        if ($this->getCode() != '00000') {
          $this -> setCode($code = $this -> getBody()['code'] ?? '500');
          $this -> setMessage($this -> getBody()['msg'] ?? '未知错误');
          $message = '【' . $this->getCode() . '】' . $this->getMessage();
          throw new ValidateResponseException($message);
        }
    }
}
