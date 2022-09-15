<?php

namespace App\Service;

use Stripe\PaymentIntent;
use Stripe\Stripe;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class StripePayment
{
    /**
     * @var string
     */
    private $secretKey;

    public function __construct(ParameterBagInterface $param)
    {
        $this->secretKey = $param->get('app.secretKey');
    }

    public function paymentIntent(float $amount = 1.0)
    {
        Stripe::setApiKey($this->secretKey);

        return PaymentIntent::create([
            'amount' => $amount * 1000,
            'currency' => 'EUR',
            'payment_method_types' => ['card']
        ]);
    }
}
