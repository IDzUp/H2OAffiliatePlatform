<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class LoginForm extends BaseForm
{
    public static function display($sMod = self::AFFILIATE)
    {
        if (isset($_POST['submit_login']))
        {
            if (\PFBC\Form::isValid($_POST['submit_login']))
                new LoginProcessForm($sMod);

            redirect('?m=' . $sMod . '&a=login');
        }

        $oForm = new \PFBC\Form('login_form');
        $oForm->configure(array('action' => ''));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_login', 'login_form'));
        $oForm->addElement(new \PFBC\Element\Email(trans('Email'), 'email', array('required' => 1)));
        $oForm->addElement(new \PFBC\Element\Password(trans('Password'), 'password', array('required' => 1)));
        $oForm->addElement(new \PFBC\Element\Button(trans('Login')));
        $oForm->addElement(new \PFBC\Element\HTML('<a href="?m=' . $sMod . '&amp;c=main&amp;a=forgot">' . trans('Forgot your password?') . '</a>'));
        $oForm->render();
    }

}