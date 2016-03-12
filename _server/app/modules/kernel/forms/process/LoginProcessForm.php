<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class LoginProcessForm extends Controller
{

    public function __construct($sMod)
    {
        parent::__construct();

        $oAffModel = new KernelModel;
        $sType = ($sMod == 'affiliate') ? 'aff' : $sMod;

        if ($oAffModel->login($this->oHttpRequest->post('email'), $this->oHttpRequest->post('password')))
        {
            $iId = $oAffModel->getId($this->oHttpRequest->post('email'));
            $oAffData = $oAffModel->readProfile($iId);

            // Regenerate the session ID to prevent the session fixation
            $this->oSession->regenerateId();

            $aSessData = [
               $sType . '_id' => $oAffData->profileId,
               $sType . '_email' => $oAffData->email,
               $sType . '_name' => $oAffData->name,
               $sType . '_ip' => client_ip(),
               $sType . '_http_user_agent' => user_agent(),
               $sType . '_token' => Various::genRnd($oAffData->email),
            ];
            $this->oSession->set($aSessData);

            \PFBC\Form::setSuccess('login_form', trans('You have successfully logged in!'));

            redirect('?m=' . $sMod . '&a=index');
        }
        else
        {
            \PFBC\Form::setError('login_form', trans('Email or Password is invalid'));
        }
    }

}
