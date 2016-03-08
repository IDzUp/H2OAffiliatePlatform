<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

if (!Admin::auth() && Application::getAction() !== 'login')
{
    redirect('?m=admin&a=login');
}

// If the admin is logged, don't show the login form
if (Admin::auth() && Application::getAction() === 'login')
{
    redirect('?m=admin&a=index');
}

