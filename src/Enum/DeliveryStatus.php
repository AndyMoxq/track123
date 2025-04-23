<?php
namespace Track123\OpenApi\Enum;
enum DeliveryStatus :string {
  case INIT = 'New shipments added that are pending to be tracked.';
  case NO_RECORD = 'This shipment has no tracking information available yet.';
  case INFO_RECEIVED = 'The carrier has received a request from the shipper and is preparing to pick up the package.';
  case IN_TRANSIT = 'The shipment is in transit.';
  case WAITING_DELIVERY = 'The shipment is out for delivery or has arrived at the collection point for pick up.';
  case DELIVERY_FAILED = 'Carrier attempted to deliver but failed due to address issues, unavailability of the recipient, etc.';
  case ABNORMAL = 'Parcels are damaged, returned, customs detained, and other abnormal situations.';
  case DELIVERED = 'Parcel was delivered successfully.';
  case EXPIRED = 'Parcel has had no tracking information for 50 days since added.';
  public function label(): string
  {
      return match($this) {
          self::INIT => '待揽收',
          self::NO_RECORD => '无轨迹',
          self::INFO_RECEIVED => '已预报',
          self::IN_TRANSIT => '运输中',
          self::WAITING_DELIVERY => '待派送',
          self::DELIVERY_FAILED => '派送失败',
          self::ABNORMAL => '异常',
          self::DELIVERED => '已签收',
          self::EXPIRED => '已过期',
      };
  }
}