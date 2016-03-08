<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class PaymentProcessForm extends Controller
{

    public function __construct($iPageId)
    {
        parent::__construct();

        if ($this->oHttpRequest->postExists('stripeToken')) {
            \Stripe\Stripe::setApiKey(Config::STRIPE_SECRET_KEY);

            try {
                $oCharge = \Stripe\Charge::create(
                    [
                         'amount' => Config::AFFILIATE_MEMBERSHIP_PRICE,
                        'currency' => 'usd',
                        'source' => $token,
                        'description' => 'Charged affiliate membership'
                    ]
                );
                // It's OK
            } catch(\Stripe\Error\Card $oE) {
            // The card has been declined
            }
    }

}

