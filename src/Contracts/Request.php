<?php
namespace Track123\OpenApi\Contracts;
use Track123\OpenApi\Exception\ValidateRequestException;

/**
 * Class Request
 * 用于构建和管理 API 请求的数据结构，包括 headers、body 和 uri。
 */
abstract class Request {
    /**
     * 请求头数组
     * @var array
     */
    protected $headers = [];

    /**
     * 请求体数组
     * @var array
     */
    protected $body = [];

    /**
     * 请求 URI
     * @var string
     */
    protected $uri = '';

    /**
     * 请求方法
     * @var string
     */
    protected $method = 'POST';

    /**
     * @var string 请求数据格式
     */
    protected $dataType = 'JSON';

    /**
     * 错误信息集合
     * @var array
     */
    protected array $errors = [];

    /**
     * 获取所有错误信息
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * 添加一条错误信息
     *
     * @param string $message
     * @return void
     */
    protected function addError(string $message): void
    {
        $this->errors[] = $message;
    }

    /**
     * 设置请求体
     *
     * @param array $body
     * @return static
     */
    public function setBody(array $body): static {
        $this->body = $body;
        return $this;
    }

    /**
     * 设置或移除 body 中的一个键值对
     *
     * @param string $key
     * @param mixed|null $value 传入 null 表示移除该键
     * @return static
     */
    public function setCondition(string $key, $value): static {
        if ($value === null) {
            unset($this->body[$key]);
        } else {
            $this->body[$key] = $value;
        }
        return $this;
    }

    /**
     * 获取请求体
     *
     * @return array
     */
    public function getBody(): array {
        return $this->body;
    }

    /**
     * 添加一个 header（如不存在）
     *
     * @param string $header
     * @return static
     */
    public function setHeader($header): static {
        if (!in_array($header, $this->headers, true)) {
            $this->headers[] = $header;
        }
        return $this;
    }

    /**
     * 获取所有 headers
     *
     * @return array
     */
    public function getHeaders(): array {
        return $this->headers;
    }

    /**
     * 批量设置 headers
     *
     * @param array $headers
     * @return static
     */
    public function setHeaders(array $headers): static {
        $this->headers = $headers;
        return $this;
    }

    /**
     * 设置请求的 URI
     *
     * @param string $uri
     * @return static
     */
    public function setApiUri(string $uri): static {
        $this->uri = $uri;
        return $this;
    }

    /**
     * 获取请求 URI
     *
     * @return string
     */
    public function getApiUri(): string {
        return $this->uri;
    }

    /**
     * 设置请求方法
     *
     * @param string $method
     * @return static
     */
    public function setMethod(string $method = 'POST'): static {
        $this->method = $method;
        return $this;
    }

    /**
     * 获取请求方法
     *
     * @return string
     */
    public function getMethod(): string {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * 解析字符串风格的规则为标准数组格式
     *
     * @param string $fieldName
     * @param mixed $value
     * @param string $ruleStr
     * @return array[]
     */
    protected function resolveStringRules(string $fieldName, $value, string $ruleStr): array
    {
        $segments = explode('|', $ruleStr);
        $rules = [];

        foreach ($segments as $segment) {
            if (str_starts_with($segment, 'max:')) {
                $rules[] = [
                    'method' => 'validateMaxLength',
                    'args' => [$fieldName, $value, (int)substr($segment, 4)],
                ];
            } elseif (str_starts_with($segment, 'min:')) {
                $rules[] = [
                    'method' => 'validateMinLength',
                    'args' => [$fieldName, $value, (int)substr($segment, 4)],
                ];
            } elseif ($segment === 'required') {
                $rules[] = [
                    'method' => 'validateRequired',
                    'args' => [$fieldName, $value, true],
                ];
            } elseif ($segment === 'nullable') {
                // 忽略
            } elseif ($segment === 'email') {
                $rules[] = [
                    'method' => 'validatePattern',
                    'args' => [$fieldName, $value, '[\w\.\-]+@[\w\.\-]+\.\w+'],
                ];
            }
        }

        return $rules;
    }

    /**
     * @param $fieldName
     * @param $field
     * @param $val
     */
    public function validateRequired($fieldName, $field, $val = null)
    {
        if (true === $val && null === $field) {
            $this->addError($fieldName . ' is required');
        }
    }

    /**
     * @param $fieldName
     * @param $field
     * @param $val
     */
    public function validateMinLength($fieldName, $field, $val = null)
    {
        if (null !== $field && \strlen($field) < (int)$val) {
            $this->addError($fieldName . ' is less than min-length: ' . $val);
        }
    }

    /**
     * @param $fieldName
     * @param $field
     * @param string $regex
     */
    public function validatePattern($fieldName, $field, $regex = '')
    {
        if (null !== $field && '' !== $field && !preg_match("/^{$regex}$/", $field)) {
            $this->addError($fieldName . ' is not match ' . $regex);
        }
    }

    /**
     * @param $fieldName
     * @param $field
     * @param $val
     */
    public function validateMaximum($fieldName, $field, $val)
    {
        if (null !== $field && $field > $val) {
            $this->addError($fieldName . ' cannot be greater than ' . $val);
        }
    }

    /**
     * @param $fieldName
     * @param $field
     * @param $val
     */
    public function validateMinimum($fieldName, $field, $val)
    {
        if (null !== $field && $field < $val) {
            $this->addError($fieldName . ' cannot be less than ' . $val);
        }
    }

    /**
     * @throws ValidateRequestException
     */
    public function throwErrors(){
        if (!empty($this -> getErrors())) {
            throw new ValidateRequestException(implode(';',$this -> getErrors()), 1);
        }
    }

    /**
     * @return mixed
     */
    abstract public function validate();
}