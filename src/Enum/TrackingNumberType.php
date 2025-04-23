<?php
namespace Track123\OpenApi\Enum;

/**
 * 轨迹编号类型枚举
 */
enum TrackingNumberType: int
{
    /** 订舱号 */
    case BOOKING_NUMBER = 1;

    /** 提单号 */
    case BILL_OF_LANDING_NUMBER = 2;

    /** 箱号 */
    case CONTAINER_NUMBER = 3;

    /**
     * 获取中文标签
     *
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            self::BOOKING_NUMBER => '订舱号',
            self::BILL_OF_LANDING_NUMBER => '提单号',
            self::CONTAINER_NUMBER => '箱号',
        };
    }
}