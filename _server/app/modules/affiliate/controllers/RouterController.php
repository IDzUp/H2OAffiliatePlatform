<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2016, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class RouterController extends Controller
{

    /**
     * Set the reference to the visitor.
     *
     * @return void
     */
    public function refer()
    {
        if ($this->oHttpRequest->exists('id')) {
            if ((new KernelModel(KernelModel::AFF_TABLE))->isFound($this->oHttpRequest->get('id'), 'profileId'))
                (new Affiliate)->addRefer($this->oHttpRequest->get('id'));
        }

        redirect(H2O_ROOT_URL . $this->oHttpRequest->get('action'));
    }

}
