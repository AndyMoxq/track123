<?php
namespace Track123\OpenApi\System;

use Track123\OpenApi\Contracts\Client;
use Track123\OpenApi\System\Request\AppUnityRequest;
use Track123\OpenApi\System\Request\Trackings\RegisterTrackingRequest;
use Track123\OpenApi\System\Request\Trackings\GetTrackingsRequest;
use Track123\OpenApi\System\Request\Carriers\GetCarrierListRequest;
use Track123\OpenApi\System\Request\OceanCargo\GetOceanCargoCarriesRequest;
use Track123\OpenApi\System\Request\OceanCargo\RegisterOceanCargoTrackingRequest;
use Track123\OpenApi\System\Request\OceanCargo\ChangeOceanCargoCarrierRequest;
use Track123\OpenApi\System\Request\OceanCargo\GetOceanCargoTrackingsRequest;
use Track123\OpenApi\System\Request\OceanCargo\DeleteOceanCargoTrackingsRequest;
use Track123\OpenApi\System\Response\AppUnityResponse;
use Track123\OpenApi\System\Response\Trackings\RegisterTrackingResponse;
use Track123\OpenApi\System\Response\Trackings\GetTrackingsResponse;
use Track123\OpenApi\System\Response\Carriers\GetCarrierListResponse;
use Track123\OpenApi\System\Response\OceanCargo\GetOceanCargoCarriesResponse;
use Track123\OpenApi\System\Response\OceanCargo\RegisterOceanCargoTrackingResponse;
use Track123\OpenApi\System\Response\OceanCargo\ChangeOceanCargoCarrierResponse;
use Track123\OpenApi\System\Response\OceanCargo\GetOceanCargoTrackingsResponse;
use Track123\OpenApi\System\Response\OceanCargo\DeleteOceanCargoTrackingsResponse;

class System extends Client
{
    /**
     * 调用 App 授权绑定接口
     *
     * @param AppUnityRequest $request
     * @return AppUnityResponse
     * @throws \Track123\OpenApi\Exception\InvalidResponseException
     */
    public function appUnity(AppUnityRequest $request): AppUnityResponse
    {
        return AppUnityResponse::format($this->doRequest($request));
    }

    /**
     * 注册轨迹信息
     *
     * @param RegisterTrackingRequest $request
     * @return RegisterTrackingResponse
     * @throws \Track123\OpenApi\Exception\InvalidResponseException
     */
    public function registerTracking(RegisterTrackingRequest $request): RegisterTrackingResponse
    {
        return RegisterTrackingResponse::format($this->doRequest($request));
    }

    /**
     * 获取承运商列表
     *
     * @param GetCarrierListRequest $request
     * @return GetCarrierListResponse
     * @throws \Track123\OpenApi\Exception\InvalidResponseException
     */
    public function getCarrierList(GetCarrierListRequest $request): GetCarrierListResponse
    {
        return GetCarrierListResponse::format($this->doRequest($request));
    }

    /**
     * 查询轨迹信息
     *
     * @param GetTrackingsRequest $request
     * @return GetTrackingsResponse
     * @throws \Track123\OpenApi\Exception\InvalidResponseException
     */
    public function getTrackings(GetTrackingsRequest $request): GetTrackingsResponse
    {
        return GetTrackingsResponse::format($this->doRequest($request));
    }

    /**
     * 查询海运支持列表
     *
     * @param GetOceanCargoCarriesRequest $request
     * @return GetOceanCargoCarriesResponse
     */
    public function getOceanCargoCarries(GetOceanCargoCarriesRequest $request): GetOceanCargoCarriesResponse{
        return GetOceanCargoCarriesResponse::format($this -> doRequest($request));
    }

    public function registerOceanCargoTracking(RegisterOceanCargoTrackingRequest $request): RegisterOceanCargoTrackingResponse{
        return RegisterOceanCargoTrackingResponse::format($this -> doRequest($request));
    }

    public function changeOceanCargoCarrier(ChangeOceanCargoCarrierRequest $request): ChangeOceanCargoCarrierResponse{
        return ChangeOceanCargoCarrierResponse::format($this -> doRequest($request));
    }

    public function getOceanCargoTrackings(GetOceanCargoTrackingsRequest $request): GetOceanCargoTrackingsResponse {
        return GetOceanCargoTrackingsResponse::format($this -> doRequest($request));
    }

    public function deleteOceanCargoTrackings(DeleteOceanCargoTrackingsRequest $request): DeleteOceanCargoTrackingsResponse{
        return DeleteOceanCargoTrackingsResponse::format($this -> doRequest($request));
    }

}
