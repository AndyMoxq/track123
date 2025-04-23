<?php
namespace Track123\OpenApi\Enum;

enum DeliverySubStatus: string
{
    // In Transit
    case IN_TRANSIT_01 = "Parcel is on it's way.";
    case IN_TRANSIT_02 = 'Parcels have arrived at the sorting center.';
    case IN_TRANSIT_03 = 'Parcel customs clearance completed.';
    case IN_TRANSIT_04 = 'Dispatching, the package has been encapsulated and will be sent to the airport soon.';
    case IN_TRANSIT_05 = 'The package has been handed over to the airline and is being sent to the destination country.';
    case IN_TRANSIT_06 = 'Landed, the package has arrived in the destination country.';
    case IN_TRANSIT_07 = 'The parcel has arrived at the local post office or courier outlet and delivery will be arranged soon.';
    case IN_TRANSIT_08 = 'The package is on the plane and the plane has departed.';

    // Waiting Delivery
    case WAITING_DELIVERY_01 = 'The parcel is out for delivery.';
    case WAITING_DELIVERY_02 = 'The parcel has arrived at the collection point for receipts to pick up.';
    case WAITING_DELIVERY_03 = 'The recipient requests a delayed delivery or the courier leaves a note after a failed delivery waiting for a second delivery.';

    // Delivered
    case DELIVERED_01 = 'Parcel delivered successfully.';
    case DELIVERED_02 = 'Successful pick-up by the recipient at the collection point.';
    case DELIVERED_03 = 'Parcel delivered and signed by the customer.';
    case DELIVERED_04 = 'Parcel delivered to property owners, doormen, family members, or neighbors';

    // Delivery Failed
    case DELIVERY_FAILED_01 = 'Delivery failed due to address related issues.';
    case DELIVERY_FAILED_02 = 'Delivery failed due to the recipient was not at home.';
    case DELIVERY_FAILED_03 = 'Delivery failed due to the recipient can not being reached.';
    case DELIVERY_FAILED_04 = 'Delivery failed due to other reasons.';

    // Abnormal
    case ABNORMAL_01 = 'Parcel unclaimed.';
    case ABNORMAL_02 = 'Parcels detained by customs.';
    case ABNORMAL_03 = 'The package is damaged, lost, or discarded.';
    case ABNORMAL_04 = 'The order is canceled.';
    case ABNORMAL_05 = 'The recipient refuses to accept the parcel.';
    case ABNORMAL_06 = 'The return package has been successfully received by the sender.';
    case ABNORMAL_07 = 'The package is on its way to the sender.';
    case ABNORMAL_08 = 'Other exceptions.';

    // Info Received
    case INFO_RECEIVED_01 = 'The carrier has received a request from the shipper and is preparing to pick up the package.';

    public function label(): string
    {
        return match($this) {
            self::IN_TRANSIT_01 => '运输中-派送途中',
            self::IN_TRANSIT_02 => '运输中-到达分拣中心',
            self::IN_TRANSIT_03 => '运输中-清关完成',
            self::IN_TRANSIT_04 => '运输中-准备发往机场',
            self::IN_TRANSIT_05 => '运输中-交航空公司',
            self::IN_TRANSIT_06 => '运输中-抵达目的国',
            self::IN_TRANSIT_07 => '运输中-到达快递网点',
            self::IN_TRANSIT_08 => '运输中-航班起飞',

            self::WAITING_DELIVERY_01 => '待派送-派送中',
            self::WAITING_DELIVERY_02 => '待派送-到达自提点',
            self::WAITING_DELIVERY_03 => '待派送-用户要求延迟或二次派送',

            self::DELIVERED_01 => '已签收-正常签收',
            self::DELIVERED_02 => '已签收-自提点取件',
            self::DELIVERED_03 => '已签收-客户签收',
            self::DELIVERED_04 => '已签收-代收',

            self::DELIVERY_FAILED_01 => '派送失败-地址问题',
            self::DELIVERY_FAILED_02 => '派送失败-收件人不在家',
            self::DELIVERY_FAILED_03 => '派送失败-无法联系收件人',
            self::DELIVERY_FAILED_04 => '派送失败-其他原因',

            self::ABNORMAL_01 => '异常-无人认领',
            self::ABNORMAL_02 => '异常-海关扣押',
            self::ABNORMAL_03 => '异常-破损/丢失/废弃',
            self::ABNORMAL_04 => '异常-订单取消',
            self::ABNORMAL_05 => '异常-收件人拒收',
            self::ABNORMAL_06 => '异常-退件已签收',
            self::ABNORMAL_07 => '异常-退件途中',
            self::ABNORMAL_08 => '异常-其他',

            self::INFO_RECEIVED_01 => '已预报-等待揽收',
        };
    }
}