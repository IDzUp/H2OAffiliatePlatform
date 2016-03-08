<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class AddAccountProcessForm extends Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!validate_identical($this->oHttpRequest->post('password1'), $this->oHttpRequest->post('password2')))
        {
            \PFBC\Form::setError('add_account_form', trans('Different Password'));
        }
        elseif (find($this->oHttpRequest->post('password1'), $this->oHttpRequest->post('name')))
        {
            \PFBC\Form::setError('add_account_form', trans('For your security, your password must be different than your name'));
        }
        else
        {

            $aData = [
                'email' => $this->oHttpRequest->post('email'),
                'name' => $this->oHttpRequest->post('name'),
                'password' => Security::hashPwd($this->oHttpRequest->post('password1')),
                'ip' => client_ip()
            ];

            if((new InstallModel)->exe($aData, 'add_user'))
            {
                // Success
                \PFBC\Form::clearValues('add_account_form');
                \PFBC\Form::setSuccess('add_account_form', trans('Your account has been successfully created'));

                /*** Send an email to say the installation is done, and give some information... ***/
                $aParams = array(
                    'to' => $aData['email'],
                    'subject' => trans('Congratulations, the installation of your website is finished!'),
                    'body' => '<p><strong>' . trans('Congratulations, your website is now successfully installed!') . '</strong></p>' .
                        '<p>' . trans("We hope you'll enjoy using %0%!", '<em>' . Application::SOFTWARE_NAME . '</em>') . '</p>' .
                        '<p>' . trans('For any bug reports, suggestions, partnership, translation, contribution or other, please visit our %0%', '<a href="' . Application::SOFTWARE_WEBSITE . '">' . trans('website') . '</a>') . '</p>' .
                        '<p>---</p>' .
                        '<p>' . trans('Kind regards,') . '</p>' .
                        '<p>' . trans('The %0% team.', Application::SOFTWARE_NAME) . '</p>'
                );
                send_mail($aParams);

                redirect('?m=install&a=finish');
            }
            else
            {
                \PFBC\Form::setError('add_account_form', trans('Error occurred'));
            }
        }
    }

}