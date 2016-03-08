<?php
/**
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2016, Pierre-Henry Soria. All Rights Reserved.
 * @license          See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
 * @link             http://hizup.com
 */

namespace H2O;
defined('H2O') or exit('Access denied');

class KernelModel extends Model
{

    const AFF_TABLE = 'Affiliate', ADMIN_TABLE = 'Admin';

    protected $sQueryPath, $sSql, $sTable;

    public function __construct($sTable = self::AFF_TABLE)
    {
        parent::__construct();
        $this->sQueryPath = __DIR__ . H2O_DS . 'queries/';
        $this->sTable = $sTable;
    }

    public function exe(array $aParams, $sSqlName)
    {
        return $this->exec($sSqlName, $this->sQueryPath, $aParams);
    }

    public function isFound($sValue, $sColumn)
    {
        $this->sSql = $this->getQuery('is_found', $this->sQueryPath);
        $this->replaceTable();
        $rStmt = $this->oDb->prepare( str_replace('[COLUMN]', $sColumn, $this->sSql) );
        $rStmt->bindValue(':column', $sValue);
        $rStmt->execute();
        return ($rStmt->fetchColumn() == 1);
    }

    public function login($sEmail, $sPassword)
    {
        $this->sSql = $this->getQuery('login', $this->sQueryPath);
        $this->replaceTable();
        $rStmt = $this->oDb->prepare($this->sSql);
        $rStmt->bindValue(':email', $sEmail);
        $rStmt->execute();
        $oRow = $rStmt->fetch(\PDO::FETCH_OBJ);
        return Security::checkPwd($sPassword, @$oRow->password);
    }

    public function readProfile($iId)
    {
        $iId = (int) $iId;
        $this->sSql = $this->getQuery('read_profile', $this->sQueryPath);
        $this->replaceTable();
        $rStmt = $this->oDb->prepare($this->sSql);
        $rStmt->bindValue(':profile_id', $iId, \PDO::PARAM_INT);
        $rStmt->execute();
        return $rStmt->fetch(\PDO::FETCH_OBJ);
    }


    public function getId($sEmail)
    {
        $this->sSql = $this->getQuery('get_id', $this->sQueryPath);
        $this->replaceTable();
        $rStmt = $this->oDb->prepare($this->sSql);
        $rStmt->bindValue(':email', $sEmail);
        $rStmt->execute();
        $oRow = $rStmt->fetch(\PDO::FETCH_OBJ);
        return (int) @$oRow->profileId;
    }

    public function getAd($iId)
    {
        $iId = (int) $iId;

        $rStmt = $this->oDb->prepare( $this->getQuery('get_ad', $this->sQueryPath) );
        $rStmt->bindValue(':ad_id', $iId, \PDO::PARAM_INT);
        $rStmt->execute();
        $oRow = $rStmt->fetch(\PDO::FETCH_OBJ);
        return (!empty($oRow->code)) ? $oRow->code : '';
    }

    public function getAds()
    {
        $rStmt = $this->oDb->prepare( $this->getQuery('get_ads', $this->sQueryPath) );
        $rStmt->execute();
        return $rStmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getAnalytics()
    {
        $rStmt = $this->oDb->prepare( $this->getQuery('get_analytics', $this->sQueryPath) );
        $rStmt->execute();
        $oRow = $rStmt->fetch(\PDO::FETCH_OBJ);
        return (!empty($oRow->code)) ? $oRow->code : '';
    }

    public function getLang($iId)
    {
        $iId = (int) $iId;
        $this->sSql = $this->getQuery('get_lang', $this->sQueryPath);
        $this->replaceTable();
        $rStmt = $this->oDb->prepare($this->sSql);
        $rStmt->bindValue(':profile_id', $iId, \PDO::PARAM_INT);
        $rStmt->execute();
        $oRow = $rStmt->fetch(\PDO::FETCH_OBJ);
        return @$oRow->lang;
    }

    protected function replaceTable()
    {
        $this->checkTable();
        $this->sSql = str_replace('[TABLE]', $this->sTable, $this->sSql);
    }

    /**
     * Check if the DB table is correct.
     *
     * @return integer 1 (with exit function).
     * @throws \Exception Explanatory message.
     */
    protected function checkTable()
    {
        switch($this->sTable)
        {
            case self::AFF_TABLE:
            case self::ADMIN_TABLE:
                return $this->sTable;
            break;

            default:
                throw new \Exception('Wrong Table Specified');
                exit(1);
        }

    }

}
