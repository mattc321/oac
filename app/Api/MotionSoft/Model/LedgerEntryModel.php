<?php

namespace App\Api\MotionSoft\Model;

class LedgerEntryModel
{
    /**
     * @var string|null
     */
    private $ID;
    /**
     * @var int|null
     */
    private $TID;
    /**
     * @var string|null
     */
    private $SourceID;
    /**
     * @var string|null
     */
    private $Saledate;
    /**
     * @var string|null
     */
    private $Descrip;
    /**
     * @var int|null
     */
    private $InvNo;
    /**
     * @var string|null
     */
    private $Method;
    /**
     * @var string|null
     */
    private $Source;
    /**
     * @var int|null
     */
    private $SortOrder;
    /**
     * @var int|null
     */
    private $cfsTransactionID;
    /**
     * @var int|null
     */
    private $Transno;
    /**
     * @var string|null
     */
    private $TableName;
    /**
     * @var string|null
     */
    private $ItemID;
    /**
     * @var string|null
     */
    private $DescripTwo;
    /**
     * @var string|null
     */
    private $Gender;
    /**
     * @var float|null
     */
    private $Total;
    /**
     * @var float|null
     */
    private $RunningTotal;

    public function __construct(array $memberLedgerEntry)
    {
        $this->ID = $memberLedgerEntry['ID'] ?? null;
        $this->TID = $memberLedgerEntry['TID'] ?? null;
        $this->SourceID = $memberLedgerEntry['SourceID'] ?? null;
        $this->Saledate = $memberLedgerEntry['Saledate'] ?? null;
        $this->Descrip = $memberLedgerEntry['Descrip'] ?? null;
        $this->InvNo = $memberLedgerEntry['InvNo'] ?? null;
        $this->Method = $memberLedgerEntry['Method'] ?? null;
        $this->Source = $memberLedgerEntry['Source'] ?? null;
        $this->SortOrder = $memberLedgerEntry['SortOrder'] ?? null;
        $this->cfsTransactionID = $memberLedgerEntry['cfsTransactionID'] ?? null;
        $this->Transno = $memberLedgerEntry['Transno'] ?? null;
        $this->TableName = $memberLedgerEntry['TableName'] ?? null;
        $this->ItemID = $memberLedgerEntry['ItemID'] ?? null;
        $this->DescripTwo = $memberLedgerEntry['DescripTwo'] ?? null;
        $this->Gender = $memberLedgerEntry['Gender'] ?? null;
        $this->Total = $memberLedgerEntry['Total'] ?? null;
        $this->RunningTotal = $memberLedgerEntry['RunningTotal'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @return int|null
     */
    public function getTID()
    {
        return $this->TID;
    }

    /**
     * @return string|null
     */
    public function getSourceID()
    {
        return $this->SourceID;
    }

    /**
     * @return string|null
     */
    public function getSaledate()
    {
        return $this->Saledate;
    }

    /**
     * @return string|null
     */
    public function getDescrip()
    {
        return $this->Descrip;
    }

    /**
     * @return int|null
     */
    public function getInvNo()
    {
        return $this->InvNo;
    }

    /**
     * @return string|null
     */
    public function getMethod()
    {
        return $this->Method;
    }

    /**
     * @return string|null
     */
    public function getSource()
    {
        return $this->Source;
    }

    /**
     * @return int|null
     */
    public function getSortOrder()
    {
        return $this->SortOrder;
    }

    /**
     * @return int|null
     */
    public function getCfsTransactionID()
    {
        return $this->cfsTransactionID;
    }

    /**
     * @return int|null
     */
    public function getTransno()
    {
        return $this->Transno;
    }

    /**
     * @return string|null
     */
    public function getTableName()
    {
        return $this->TableName;
    }

    /**
     * @return string|null
     */
    public function getItemID()
    {
        return $this->ItemID;
    }

    /**
     * @return string|null
     */
    public function getDescripTwo()
    {
        return $this->DescripTwo;
    }

    /**
     * @return string|null
     */
    public function getGender()
    {
        return $this->Gender;
    }

    /**
     * @return float|null
     */
    public function getTotal()
    {
        return $this->Total;
    }

    /**
     * @return float|null
     */
    public function getRunningTotal()
    {
        return $this->RunningTotal;
    }
}
