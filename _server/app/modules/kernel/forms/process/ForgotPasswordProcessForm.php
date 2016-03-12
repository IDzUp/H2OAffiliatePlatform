<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class ForgotPasswordProcessForm extends Controller
{

    public function __construct()
    {
        parent::__construct();

        $sEmail = $this->oHttpRequest->post('email');
        $sNewPassword = mt_rand(5,15);

        (new AffiliateModel)->resetPassword($sEmail, $sNewPassword);

        /*** Send an email containing the new password... ***/
        $aParams = [
            'to' => $sEmail,
            'subject' => trans('New Password'),
            'body' => '<p>Hi there!</p>' .
            '<p>' . trans('We received a new request to change your password. Your new password is %0%.', $sNewPassword) . '</p>' .
            '<p>' . trans('For security amd memorisation reason, please change your password to a new one once logged in in your account.') . '</p>' .
            '<p>' . trans('Kind regards,') . '</p>' .
            '<p>' . trans('The %0% team.', Application::SOFTWARE_NAME) . '</p>'
        ];

        send_mail($aParams);

        \PFBC\Form::setSuccess('forgot_password_form', trans('We sent a new password to your emailbox!'));
    }

}