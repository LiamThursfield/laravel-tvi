<?php

namespace App\Interfaces\EDU\Purchase;

class PurchaseInterface
{
    public const PAYMENT_STATUS_PENDING = 'PENDING';
    public const PAYMENT_STATUS_FAILED = 'FAILED';
    public const PAYMENT_STATUS_PAID = 'PAID';
    public const PAYMENT_STATUS_REFUNDED = 'REFUNDED';

    public const PAYMENT_STATUSES = [
        self::PAYMENT_STATUS_PENDING => 'Pending',
        self::PAYMENT_STATUS_FAILED => 'Failed',
        self::PAYMENT_STATUS_PAID => 'Paid',
        self::PAYMENT_STATUS_REFUNDED => 'Refunded',
    ];


    public const CURRENCY_RO = 'LEI';
    public const CURRENCY_GB = 'GBP';
    public const CURRENCY_EU = 'E';

    public const CURRENCIES = [
        self::CURRENCY_RO => 'Lei',
        self::CURRENCY_GB => '£',
        self::CURRENCY_EU => '€',
    ];

    public const PAYMENT_GATEWAY_STRIPE = 'STRIPE';

    public const PAYMENT_GATEWAYS = [
        self::PAYMENT_GATEWAY_STRIPE => 'Stripe',
    ];
}
