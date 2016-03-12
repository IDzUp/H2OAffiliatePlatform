<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class RegistrationForm
{
    public static function display()
    {
        if (isset($_POST['submit_registration']))
        {
            if (\PFBC\Form::isValid($_POST['submit_registration']))
                new RegistrationProcessForm;

            redirect('?m=homepage&c=main');
        }

        $oForm = new \PFBC\Form('registration_form');
        $oForm->configure(array('action' => ''));
        $oForm->addElement(new \PFBC\Element\Hidden('submit_registration', 'registration_form'));
        $oForm->addElement(new \PFBC\Element\Textbox(trans('Full Name'), 'name', ['validation' => new \PFBC\Validation\Str(2,40), 'required' => 1]));
        $oForm->addElement(new \PFBC\Element\Email(trans('Email'), 'email', ['required' => 1]));
        $oForm->addElement(new \PFBC\Element\Password(trans('Password'), 'password1', ['required' => 1]));
        $oForm->addElement(new \PFBC\Element\Password(trans('Repeat Password'), 'password2', ['required' => 1]));
        $oForm->addElement(new \PFBC\Element\Textbox(trans('Company Name (if you are a company)'), 'company_name'));
        $oForm->addElement(new \PFBC\Element\Button(trans('Submit')));

        $oForm->render();
    }
}