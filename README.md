# Track123 OpenAPI SDK

Track123 OpenAPI SDK 是用于接入 Track123 海运/空运物流轨迹服务的 PHP 工具包。

## 📦 安装

使用 Composer 安装开发版本：

```bash
composer require track123/open-api
```

## ⚙️ 配置

```php
use Track123\OpenApi\Config;

$config = new Config('your-access-token'); // 替换为你的 token

```

## 🚚 注册轨迹信息

```php
use Track123\OpenApi\System\Request\OceanCargo\RegisterOceanCargoTrackingRequest;

$request = new RegisterOceanCargoTrackingRequest();
//单个添加
$request->addTracking('T001', 'CMA', 1)
        ->addTracking('T002', 'COSCO', 2);
$response = Track123::system($config)->registerOceanTrackings($request);
print_r($response -> getAcceptedData());
if($response -> hasRejectedData()){
    echo $response->getRejectedMessages();
}
```

## 🚚 查询海运轨迹

```php
use Track123\OpenApi\System\Request\OceanCargo\GetOceanCargoTrackingsRequest;
use Track123\OpenApi\Track123;

$request = new GetOceanCargoTrackingsRequest();
$request->setTracking('order123', 'ONEYSZPF55508400', 2); // bill of lading
//或批量添加 
//$request->setTrackings($trackings);

$response = Track123::system($config)->getOceanCargoTrackings($request);

print_r($response->getAcceptedData());

if ($response->hasRejectedData()) {
    echo $response->getRejectedMessages();
}
```

## 📖 更多功能

- 支持海运/空运注册、查询、删除轨迹
- 承运商管理接口
- 完善的类型校验、响应结构封装

## 📄 License

MIT License
