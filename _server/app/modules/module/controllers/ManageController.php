<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class ManageController extends Controller
{

    private $_oModModel;

    public function __construct() {
        parent::__construct();

        $this->_oModModel = new ModuleModel;
        $this->oView->oModModel = $this->_oModModel;
    }

    public function all()
    {
        $this->oView->sH2Title = trans('Module Manager | All');
        $this->oView->oMods = $this->_readMods();

        $this->display();
    }

    public function activated()
    {
        $this->oView->sH2Title = trans('Module Manager | Activated');
        $this->oView->oMods = $this->_readMods();

        $this->display();
    }

    public function disabled()
    {
        $this->oView->sH2Title = trans('Module Manager | Disabled');
        $this->oView->oMods = $this->_readMods();

        $this->display();
    }

    public function installed()
    {
        $this->oView->sH2Title = trans('Module Manager | Installed');
        $this->oView->oMods = $this->_readMods();

        $this->display();
    }

    public function uninstalled()
    {
        $this->oView->sH2Title = trans('Module Manager | Uninstalled');
        $this->oView->oMods = $this->_readMods();

        $this->display();
    }

    public function install()
    {
        $sMod = $this->oHttpRequest->get('what');

        $this->_oModModel->exeSqlMod(null, $sMod, 'install');
    }

    public function uninstall()
    {
        $sMod = $this->oHttpRequest->get('what');

        $this->_oModModel->exeSqlMod(null, $sMod, 'uninstall');
    }

    /**
     * Read module folders.
     *
     * @return array Returns the module folders.
     */
    private function _readMods()
    {
        return (new File)->readDirs(H2O_SERVER_PATH . 'app/modules/');
    }

}

class ModHelper
{
     public static function isModifiable($sMod)
    {
        $aMods = include dirname(__DIR__) . '/config/core_mods.inc.php';
        return !in_array($sMod, $aMods);
    }
}