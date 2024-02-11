<?php

namespace App\Exceptions\EDU\Course;

use Exception;

class InvalidCoursePurchasePaymentException extends Exception
{
    protected $code = 400;

    protected $message = 'Invalid course purchase payment URL.';
}
