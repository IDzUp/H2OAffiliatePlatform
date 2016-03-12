<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class ForgotPasswordForm extends BaseForm
{

    public static function display()
    {
        if (isset($_POST['submit_forgot_password']))
        {
            if (\PFBC\Form::isValid($_POST['submit_forgot_password']))
                new ForgotPasswordProcessForm;

            redirect('?m=affiliate&a=forgot');
        }

        $oForm = new \PFBC\Form('forgot_password_form');
        $oForm->configure(array('action' => ''));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_forgot_password', 'forgot_password_form'));
        $oForm->addElement(new \PFBC\Element\Email(trans('Your Email'), 'email', array('required' => 1)));
        $oForm->addElement(new \PFBC\Element\Button(trans('Generate a New Password')));
        $oForm->render();
    }

}