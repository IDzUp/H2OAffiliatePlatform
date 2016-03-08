<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class PaymentForm
{
    public static function display()
    {
        if (isset($_POST['submit_payment']))
        {
            if (\PFBC\Form::isValid($_POST['submit_payment']))
                new PaymentProcessForm;

            redirect('?m=homepage&c=main');
        }

        $oForm = new \PFBC\Form('payment_form');
        $oForm->configure(array('action' => ''));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_payment', 'payment_form'));
        $oForm->addElement(new \PFBC\Element\HTML('
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="' . Config::STRIPE_PUBLISH_KEY . '"
            data-name="' . Config::SITE_NAME . '"
            data-description="' . trans('Affiliate Membership') . '"
            data-amount="' . Config::AFFILIATE_MEMBERSHIP_PRICE . '"
            data-currency="USD"
            data-allow-remember-me="true"></script>'));
        $oForm->render();
    }
}