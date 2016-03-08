<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class RegistrationProcessForm extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!validate_identical($this->oHttpRequest->post('password1'), $this->oHttpRequest->post('password2')))
        {
            \PFBC\Form::setError('registration_form', trans('Different Password'));
        }
        elseif (find($this->oHttpRequest->post('password1'), $this->oHttpRequest->post('name')))
        {
            \PFBC\Form::setError('registration_form', trans('For security reason, your password must be different than your name'));
        }
        else
        {
            $aData = [
                'email' => $this->oHttpRequest->post('email'),
                'name' => $this->oHttpRequest->post('name'),
                'company_name' => $this->oHttpRequest->post('company_name'),
                'password' => Security::hashPwd($this->oHttpRequest->post('password1')),
                'ip' => client_ip()
            ];

            if((new HomepageModel)->exe($aData, 'add_user'))
            {
                // Success
                \PFBC\Form::clearValues('registration_form');
                \PFBC\Form::setSuccess('registration_form', trans('Your account has been successfully created'));

                $this->sendEmail($aData);

                \PFBC\Form::setSuccess('registration_form', trans('Your account has been successfully created!'));
            }
            else
            {
                \PFBC\Form::setError('registration_form', trans('Error occurred'));
            }
        }
    }

    /**
     * Send an email to say welcome to the user.
     *
     * @paran array $aData User data.
     * @return boolean Returns TRUE if the mail was successfully accepted for delivery, FALSE otherwise.
     */
    protected function sendEmail(array $aData)
    {
        /*** Send an email to say the installation is done, and give some information... ***/
        $aParams = [
            'to' => $aData['email'],
            'subject' => trans('Welcome %0%!', $aData['name']),
             'body' => '<p><strong>' . trans('Congratulations, you are now registered!') . '</strong></p>' .
                        '<p>' . trans("We hope you'll enjoy using %0%!", '<em>' . Config::SITE_NAME . '</em>') . '</p>' .
                        '<p>---</p>' .
                        '<p>' . trans('Kind regards,') .
                        '<br />' . Config::SITE_NAME  . '</p>'
        ];

        return send_mail($aParams);
    }
}