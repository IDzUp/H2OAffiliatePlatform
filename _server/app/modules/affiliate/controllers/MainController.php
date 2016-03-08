<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

use Khill\Lavacharts\Lavacharts;

class MainController extends Controller
{
    protected $oAffModel, $oPage;

    public function __construct()
    {
        parent::__construct();

        $this->oUserModel = new AffiliateModel;
        $this->oView->iAffId = $this->oSession->get('aff_id');
    }

    public function index()
    {
        $this->oView->sTitle = trans('Welcome!');
        $this->oView->sH2Title = trans('Welcome to your Affiliate Area!');

        $oLava = new Lavacharts; // See note below for Laravel

        $oTemperatures = $oLava->DataTable();
/*
        $oTemperatures->addDateColumn('Date')
             ->addNumberColumn('Max Temp')
             ->addNumberColumn('Mean Temp')
*/
        $this->display();
    }

    public function login()
    {
        $this->sTitle = trans('Login - Affiliate');
        $this->oView->sTitle = $this->oView->sH2Title = $this->sTitle;

        $this->display();
    }

    public function forgot()
    {
        $this->oView->sH2Title = trans('Forgot your Password?');
        $this->display();
    }

    public function password()
    {
        $this->oView->sH2Title = trans('Change your Password');
        $this->display();
    }

    public function user()
    {
        $oUser = $this->oUserModel->get( $this->oHttpRequest->get('id') );

        if (!empty($oUser) && is_file(H2O_PUBLIC_DATA_PATH . 'user/file/' . $oUser->file))
        {
            $this->sTitle = $oUser->title;

            $this->oView->sTitle = $this->sTitle;
            $this->oView->sH2Title = $this->sTitle;
            $this->oView->sDescription = trans('User') . $oUser->description;
             $this->oView->sKeywords = $oUser->keywords;
            $this->oView->iId = $oUser->userId;
            $this->oView->sStats = $this->oUserModel->getView($oUser->userId);
            $this->oView->sDownloads = $this->oUserModel->getDownloadStat($oUser->userId);
            $this->oView->sName = $oUser->name;
            $this->oView->sFullFile = H2O_PUBLIC_DATA_URL . 'user/file/' . $oUser->file;

            /** Display HTML content **/
            $this->oView->setAutoEscape(false); // Don't escape to allow the HTML code
            $this->oView->sVotes = $this->getDesignVotes($oUser->userId, 'center');

            // Increment Statistics
            $this->oUserModel->setView($oUser->userId);
        }
        else
        {
            redirect('?m=err'); // The "err" module doesn't exist. So it'll displays the "Not Found" page.
        }

        $this->display();
    }
}
