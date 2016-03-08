<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class MainController extends Controller
{

    protected $oHomepageModel;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	$this->oView->sTitle = Config::SITE_NAME;
    	$this->oView->sH2Title = trans('Dating Affiliate System');
        $this->display();
    }

    public function ourSites()
    {
        $this->oView->sTitle = trans('Our Sites to Promote %0%', Config::SITE_NAME);
        $this->oView->sH2Title = trans('Promote Dating Sites and make 80% of the income');
        $this->display();
    }

}
