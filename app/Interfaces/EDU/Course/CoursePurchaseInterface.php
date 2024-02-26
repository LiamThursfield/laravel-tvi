<?php

namespace App\Interfaces\EDU\Course;

use Illuminate\Support\Arr;

class CoursePurchaseInterface
{
    public const CURRENCY_RO = 'RON';
    public const CURRENCY_GB = 'GBP';
    public const CURRENCY_EU = 'EUR';

    public const CURRENCIES = [
        self::CURRENCY_RO => 'RON',
        self::CURRENCY_GB => '£',
        self::CURRENCY_EU => '€',
    ];

    public const PAYMENT_GATEWAY_STRIPE = 'STRIPE';

    public const PAYMENT_GATEWAYS = [
        self::PAYMENT_GATEWAY_STRIPE => 'Stripe',
    ];

    public const PAYMENT_STATUS_FAILED = 'FAILED';
    public const PAYMENT_NOT_DUE = 'NOT_DUE';
    public const PAYMENT_OVERDUE = 'OVERDUE';
    public const PAYMENT_STATUS_PAID = 'PAID';
    public const PAYMENT_STATUS_PARTIALLY_PAID = 'PARTIALLY_PAID';
    public const PAYMENT_STATUS_PENDING = 'PENDING';
    public const PAYMENT_STATUS_REFUNDED = 'REFUNDED';

    // All Statuses, with labels
    public const PAYMENT_STATUSES = [
        self::PAYMENT_STATUS_FAILED => 'Failed',
        self::PAYMENT_NOT_DUE => 'Not Due',
        self::PAYMENT_OVERDUE => 'Overdue',
        self::PAYMENT_STATUS_PAID => 'Paid',
        self::PAYMENT_STATUS_PARTIALLY_PAID => 'Partially paid',
        self::PAYMENT_STATUS_PENDING => 'Pending',
        self::PAYMENT_STATUS_REFUNDED => 'Refunded',
    ];

    // STATUSES for COURSE PURCHASES
    public const PAYMENT_STATUSES_FOR_PURCHASES = [
        self::PAYMENT_STATUS_PAID,
        self::PAYMENT_STATUS_PARTIALLY_PAID,
        self::PAYMENT_STATUS_PENDING,
        self::PAYMENT_STATUS_REFUNDED
    ];

    // Statuses for COURSE PAYMENTS
    public const PAYMENT_STATUSES_FOR_PAYMENTS = [
        self::PAYMENT_STATUS_FAILED,
        self::PAYMENT_NOT_DUE,
        self::PAYMENT_OVERDUE,
        self::PAYMENT_STATUS_PAID,
        self::PAYMENT_STATUS_PENDING,
        self::PAYMENT_STATUS_REFUNDED,
    ];

    public const PURCHASE_TYPE_FULL = "FULL";
    public const PURCHASE_TYPE_INSTALMENTS = "INSTALMENTS";

    public const PURCHASE_TYPES = [
        self::PURCHASE_TYPE_FULL => "Full",
        self::PURCHASE_TYPE_INSTALMENTS => "Instalments"
    ];

    static function getPriceWithCurrency(string $currency, string|int $price): string
    {
        $currency = Arr::get(self::CURRENCIES, $currency, $currency);
        $price = number_format($price / 100, 2);

        return $currency . $price;
    }
}
