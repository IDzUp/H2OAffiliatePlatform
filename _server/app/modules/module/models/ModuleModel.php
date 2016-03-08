<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2014, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class ModuleModel extends Model
{

    private $_sQueryPath;

    public function __construct()
    {
        parent::__construct();
        $this->_sQueryPath = __DIR__ . H2O_DS . 'queries/';
    }

    public function exeSqlMod(array $aParams = null, $sModName, $sSqlName)
    {
        return $this->exec($sSqlName, H2O_SERVER_PATH . 'app/modules/' . $sModName . '/install/sql/' .
                Config::DB_TYPE_NAME . '/', $aParams);
    }

    public function isActivated($sModName)
    {
        $bRet = false;

        foreach ($this->getInfos() as $oInfo)
        {
            if ($sModName == $sInfo->moduleName) // If we have found the module
            {
            $bRet = ($oInfo->active == '1') ? true : false;
            break;
        }
    }
    return $bRet;
    }

    public function isDisabled($sModName)
    {
        $bRet = false;

        foreach ($this->getInfos() as $oInfo)
        {
            if ($sModName == $sInfo->moduleName) // If we have found the module
                {
            $bRet = ($oInfo->active == '0') ? true : false;
            break;
                }
        }
            return $bRet;
    }

    public function getInfos()
    {
            $rStmt = $this->oDb->prepare( $this->getQuery('get_mod_infos', $this->_sQueryPath) );
            $rStmt->execute();
            return $rStmt->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * @param boolean $bIsActivated If TURE returns only the activated modules, otherwise only the disabled modules.
     * @return integer The number of modules.
     */
    public function total($bIsActivated)
    {
            $rStmt = $this->oDb->prepare( $this->getQuery(($bIsActivated ? 'count_activated_mods' : 'count_disabled_mods'), $this->sQueryPath) );
            $rStmt->execute();
            $oRow = $rStmt->fetch(\PDO::FETCH_OBJ);
        return (int) $oRow->totalMods;
    }

}