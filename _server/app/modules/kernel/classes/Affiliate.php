<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class Affiliate
{

    /**
     * Affiliate's levels.
     *
     * @return boolean
     */
    public static function auth()
    {
        $oSess = new Session;
        return ($oSess->exists('aff_id') && $oSess->get('aff_ip') === client_ip() && $oSess->get('aff_http_user_agent') === user_agent());
    }

    /**
     * Add Refer Link.
     *
     * @param integer $iId The Affiliate Username.
     * @return void
     * @internal Today's IP address is also easier to change than delete a cookie, so we have chosen the Cookie instead save the IP address in the database.
     */
    public function addRefer($iId)
    {
        $oCookie = new Cookie;
        if (!$oCookie->exists(static::COOKIE_NAME))
        {
            $this->set('pHSAff', $iAffId, 3600*24*7); // Set a week
            (new AffiliateModel)->exe(['profile_id' => $iId], 'add_refer'); // Add a reference only for new clicks (if the cookie doesn't exist)
        }
        else
        {
            $this->set('pHSAff', $iAffId, 3600*24*7); // Set a weekek
        }
        unset($oCookie);
    }

    /**
     * Get the current affiliate's language.
     *
     * @return string
     */
    public static function getLang()
    {
        $oSess = new Session;
        return (new KernelModel)->getLang($oSess->get('aff_id'));
    }

    /**
     * Logout the affiliate.
     *
     * @param \H2O\Session $oSession
     * @param mixed (boolean | string) $mOverrideMsg Default FALSE
     * @param object \H2O\Session $oSession
     * @return void
     */
    public static function logout(Session $oSession, $mOverrideMsg = false)
    {
        $oSession->destroy();
        redirect('?m=affiliate&a=login', (!$mOverrideMsg ? trans('You have been successfully logged out') : $mOverrideMsg) ); // Redirect the admin to the login page
    }
    
}

