<?php

namespace App\Api\MotionSoft\Model;

class MemberModel
{
    /**
     * @var string|null
     */
    public $Acctnote;
    /**
     * @var string|null
     */
    public $Address1;
    /**
     * @var string|null
     */
    public $Address2;
    /**
     * @var bool|null
     */
    public $AutoBill;
    /**
     * @var string|null
     */
    public $Barcode;
    /**
     * @var string|null
     */
    public $Birthday;
    /**
     * @var string|null
     */
    public $City;
    /**
     * @var string|null
     */
    public $Company;
    /**
     * @var bool|null
     */
    public $DoNotSendTextMessages;
    /**
     * @var bool|null
     */
    public $DoNotEmail;
    /**
     * @var string|null
     */
    public $DriveLic;
    /**
     * @var string|null
     */
    public $EnteredDate;
    /**
     * @var string|null
     */
    public $Email;
    /**
     * @var string|null
     */
    public $Emercon;
    /**
     * @var string|null
     */
    public $EmerExt;
    /**
     * @var string|null
     */
    public $EmerPhone;
    /**
     * @var string|null
     */
    public $FirstName;
    /**
     * @var string|null
     */
    public $FirstBillDate;
    /**
     * @var string|null
     */
    public $FreezeEndDate;
    /**
     * @var string|null
     */
    public $FreezeStartDate;
    /**
     * @var string|null
     */
    public $Gender;
    /**
     * @var string|null
     */
    public $HomeClub;
    /**
     * @var string|null
     */
    public $ID;
    /**
     * @var string|null
     */
    public $LastName;
    /**
     * @var string|null
     */
    public $Source;
    /**
     * @var string|null
     */
    public $Membership_Type;
    /**
     * @var string|null
     */
    public $MemberStatus;
    /**
     * @var string|null
     */
    public $Memo;
    /**
     * @var string|null
     */
    public $MSDate;
    /**
     * @var string|null
     */
    public $Occupation;
    /**
     * @var string|null
     */
    public $Phone1;
    /**
     * @var string|null
     */
    public $Phone2;
    /**
     * @var string|null
     */
    public $Phone3;
    /**
     * @var int|null
     */
    public $PG_MemberID;
    /**
     * @var int|null
     */
    public $RefAgreementID;
    /**
     * @var int|null
     */
    public $RefAgreementPriceID;
    /**
     * @var string|null
     */
    public $RESPID;
    /**
     * @var string|null
     */
    public $ReDate;
    /**
     * @var string|null
     */
    public $Salesperson;
    /**
     * @var string|null
     */
    public $Salesperson2;
    /**
     * @var string|null
     */
    public $Salesperson3;
    /**
     * @var string|null
     */
    public $State;
    /**
     * @var string|null
     */
    public $TermDate;
    /**
     * @var string|null
     */
    public $Zip;

    public function __construct(
        array $memberResult
    ){
        $this->Acctnote = $memberResult['Acctnote'] ?? null;
        $this->Address1 = $memberResult['Address1'] ?? null;
        $this->Address2 = $memberResult['Address2'] ?? null;
        $this->AutoBill = $memberResult['AutoBill'] ?? null;
        $this->Barcode = $memberResult['Barcode'] ?? null;
        $this->Birthday = $memberResult['Birthday'] ?? null;
        $this->City = $memberResult['City'] ?? null;
        $this->Company = $memberResult['Company'] ?? null;
        $this->DoNotSendTextMessages = $memberResult['DoNotSendTextMessages'] ?? null;
        $this->DoNotEmail = $memberResult['DoNotEmail'] ?? null;
        $this->DriveLic = $memberResult['DriveLic'] ?? null;
        $this->EnteredDate = $memberResult['EnteredDate'] ?? null;
        $this->Email = $memberResult['Email'] ?? null;
        $this->Emercon = $memberResult['Emercon'] ?? null;
        $this->EmerExt = $memberResult['EmerExt'] ?? null;
        $this->EmerPhone = $memberResult['EmerPhone'] ?? null;
        $this->FirstName = $memberResult['FirstName'] ?? null;
        $this->FirstBillDate = $memberResult['FirstBillDate'] ?? null;
        $this->FreezeEndDate = $memberResult['FreezeEndDate'] ?? null;
        $this->FreezeStartDate = $memberResult['FreezeStartDate'] ?? null;
        $this->Gender = $memberResult['Gender'] ?? null;
        $this->HomeClub = $memberResult['HomeClub'] ?? null;
        $this->ID = $memberResult['ID'] ?? null;
        $this->LastName = $memberResult['LastName'] ?? null;
        $this->Source = $memberResult['Source'] ?? null;
        $this->Membership_Type = $memberResult['Membership_Type'] ?? null;
        $this->MemberStatus = $memberResult['MemberStatus'] ?? null;
        $this->Memo = $memberResult['Memo'] ?? null;
        $this->MSDate = $memberResult['MSDate'] ?? null;
        $this->Occupation = $memberResult['Occupation'] ?? null;
        $this->Phone1 = $memberResult['Phone1'] ?? null;
        $this->Phone2 = $memberResult['Phone2'] ?? null;
        $this->Phone3 = $memberResult['Phone3'] ?? null;
        $this->PG_MemberID = $memberResult['PG_MemberID'] ?? null;
        $this->RefAgreementID = $memberResult['RefAgreementID'] ?? null;
        $this->RefAgreementPriceID = $memberResult['RefAgreementPriceID'] ?? null;
        $this->RESPID = $memberResult['RESPID'] ?? null;
        $this->ReDate = $memberResult['ReDate'] ?? null;
        $this->Salesperson = $memberResult['Salesperson'] ?? null;
        $this->Salesperson2 = $memberResult['Salesperson2'] ?? null;
        $this->Salesperson3 = $memberResult['Salesperson3'] ?? null;
        $this->State = $memberResult['State'] ?? null;
        $this->TermDate = $memberResult['TermDate'] ?? null;
        $this->Zip = $memberResult['Zip'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getAcctnote()
    {
        return $this->Acctnote;
    }

    /**
     * @return string|null
     */
    public function getAddress1(): ?string
    {
        return $this->Address1;
    }

    /**
     * @return string|null
     */
    public function getAddress2(): ?string
    {
        return $this->Address2;
    }

    /**
     * @return bool|null
     */
    public function getAutoBill(): ?bool
    {
        return $this->AutoBill;
    }

    /**
     * @return string|null
     */
    public function getBarcode(): ?string
    {
        return $this->Barcode;
    }

    /**
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->Birthday;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->City;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->Company;
    }

    /**
     * @return bool|null
     */
    public function getDoNotSendTextMessages(): ?bool
    {
        return $this->DoNotSendTextMessages;
    }

    /**
     * @return bool|null
     */
    public function getDoNotEmail(): ?bool
    {
        return $this->DoNotEmail;
    }

    /**
     * @return string|null
     */
    public function getDriveLic(): ?string
    {
        return $this->DriveLic;
    }

    /**
     * @return string|null
     */
    public function getEnteredDate(): ?string
    {
        return $this->EnteredDate;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->Email;
    }

    /**
     * @return string|null
     */
    public function getEmercon(): ?string
    {
        return $this->Emercon;
    }

    /**
     * @return string|null
     */
    public function getEmerExt(): ?string
    {
        return $this->EmerExt;
    }

    /**
     * @return string|null
     */
    public function getEmerPhone(): ?string
    {
        return $this->EmerPhone;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    /**
     * @return string|null
     */
    public function getFirstBillDate(): ?string
    {
        return $this->FirstBillDate;
    }

    /**
     * @return string|null
     */
    public function getFreezeEndDate(): ?string
    {
        return $this->FreezeEndDate;
    }

    /**
     * @return string|null
     */
    public function getFreezeStartDate(): ?string
    {
        return $this->FreezeStartDate;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->Gender;
    }

    /**
     * @return string|null
     */
    public function getHomeClub(): ?string
    {
        return $this->HomeClub;
    }

    /**
     * @return string|null
     */
    public function getID(): ?string
    {
        return $this->ID;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->Source;
    }

    /**
     * @return string|null
     */
    public function getMembershipType(): ?string
    {
        return $this->Membership_Type;
    }

    /**
     * @return string|null
     */
    public function getMemberStatus(): ?string
    {
        return $this->MemberStatus;
    }

    /**
     * @return string|null
     */
    public function getMemo(): ?string
    {
        return $this->Memo;
    }

    /**
     * @return string|null
     */
    public function getMSDate(): ?string
    {
        return $this->MSDate;
    }

    /**
     * @return string|null
     */
    public function getOccupation(): ?string
    {
        return $this->Occupation;
    }

    /**
     * @return string|null
     */
    public function getPhone1(): ?string
    {
        return $this->Phone1;
    }

    /**
     * @return string|null
     */
    public function getPhone2(): ?string
    {
        return $this->Phone2;
    }

    /**
     * @return string|null
     */
    public function getPhone3(): ?string
    {
        return $this->Phone3;
    }

    /**
     * @return int|null
     */
    public function getPGMemberID(): ?int
    {
        return $this->PG_MemberID;
    }

    /**
     * @return int|null
     */
    public function getRefAgreementID(): ?int
    {
        return $this->RefAgreementID;
    }

    /**
     * @return int|null
     */
    public function getRefAgreementPriceID(): ?int
    {
        return $this->RefAgreementPriceID;
    }

    /**
     * @return string|null
     */
    public function getRESPID(): ?string
    {
        return $this->RESPID;
    }

    /**
     * @return string|null
     */
    public function getReDate(): ?string
    {
        return $this->ReDate;
    }

    /**
     * @return string|null
     */
    public function getSalesperson(): ?string
    {
        return $this->Salesperson;
    }

    /**
     * @return string|null
     */
    public function getSalesperson2(): ?string
    {
        return $this->Salesperson2;
    }

    /**
     * @return string|null
     */
    public function getSalesperson3(): ?string
    {
        return $this->Salesperson3;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->State;
    }

    /**
     * @return string|null
     */
    public function getTermDate(): ?string
    {
        return $this->TermDate;
    }

    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->Zip;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @return array
     */
    public function _toArray()
    {
        return $this->toArray();
    }

    /**
     * @param string|null $Acctnote
     */
    public function setAcctnote($Acctnote): void
    {
        $this->Acctnote = $Acctnote;
    }

    /**
     * @param string|null $Address1
     */
    public function setAddress1($Address1): void
    {
        $this->Address1 = $Address1;
    }

    /**
     * @param string|null $Address2
     */
    public function setAddress2($Address2): void
    {
        $this->Address2 = $Address2;
    }

    /**
     * @param bool|null $AutoBill
     */
    public function setAutoBill($AutoBill): void
    {
        $this->AutoBill = $AutoBill;
    }

    /**
     * @param string|null $Barcode
     */
    public function setBarcode($Barcode): void
    {
        $this->Barcode = $Barcode;
    }

    /**
     * @param string|null $Birthday
     */
    public function setBirthday($Birthday): void
    {
        $this->Birthday = $Birthday;
    }

    /**
     * @param string|null $City
     */
    public function setCity($City): void
    {
        $this->City = $City;
    }

    /**
     * @param string|null $Company
     */
    public function setCompany($Company): void
    {
        $this->Company = $Company;
    }

    /**
     * @param bool|null $DoNotSendTextMessages
     */
    public function setDoNotSendTextMessages($DoNotSendTextMessages): void
    {
        $this->DoNotSendTextMessages = $DoNotSendTextMessages;
    }

    /**
     * @param bool|null $DoNotEmail
     */
    public function setDoNotEmail($DoNotEmail): void
    {
        $this->DoNotEmail = $DoNotEmail;
    }

    /**
     * @param string|null $DriveLic
     */
    public function setDriveLic($DriveLic): void
    {
        $this->DriveLic = $DriveLic;
    }

    /**
     * @param string|null $EnteredDate
     */
    public function setEnteredDate($EnteredDate): void
    {
        $this->EnteredDate = $EnteredDate;
    }

    /**
     * @param string|null $Email
     */
    public function setEmail($Email): void
    {
        $this->Email = $Email;
    }

    /**
     * @param string|null $Emercon
     */
    public function setEmercon($Emercon): void
    {
        $this->Emercon = $Emercon;
    }

    /**
     * @param string|null $EmerExt
     */
    public function setEmerExt($EmerExt): void
    {
        $this->EmerExt = $EmerExt;
    }

    /**
     * @param string|null $EmerPhone
     */
    public function setEmerPhone($EmerPhone): void
    {
        $this->EmerPhone = $EmerPhone;
    }

    /**
     * @param string|null $FirstName
     */
    public function setFirstName($FirstName): void
    {
        $this->FirstName = $FirstName;
    }

    /**
     * @param string|null $FirstBillDate
     */
    public function setFirstBillDate($FirstBillDate): void
    {
        $this->FirstBillDate = $FirstBillDate;
    }

    /**
     * @param string|null $FreezeEndDate
     */
    public function setFreezeEndDate($FreezeEndDate): void
    {
        $this->FreezeEndDate = $FreezeEndDate;
    }

    /**
     * @param string|null $FreezeStartDate
     */
    public function setFreezeStartDate($FreezeStartDate): void
    {
        $this->FreezeStartDate = $FreezeStartDate;
    }

    /**
     * @param string|null $Gender
     */
    public function setGender($Gender): void
    {
        $this->Gender = $Gender;
    }

    /**
     * @param string|null $HomeClub
     */
    public function setHomeClub($HomeClub): void
    {
        $this->HomeClub = $HomeClub;
    }

    /**
     * @param string|null $ID
     */
    public function setID($ID): void
    {
        $this->ID = $ID;
    }

    /**
     * @param string|null $LastName
     */
    public function setLastName($LastName): void
    {
        $this->LastName = $LastName;
    }

    /**
     * @param string|null $Source
     */
    public function setSource($Source): void
    {
        $this->Source = $Source;
    }

    /**
     * @param string|null $Membership_Type
     */
    public function setMembershipType($Membership_Type): void
    {
        $this->Membership_Type = $Membership_Type;
    }

    /**
     * @param string|null $MemberStatus
     */
    public function setMemberStatus($MemberStatus): void
    {
        $this->MemberStatus = $MemberStatus;
    }

    /**
     * @param string|null $Memo
     */
    public function setMemo($Memo): void
    {
        $this->Memo = $Memo;
    }

    /**
     * @param string|null $MSDate
     */
    public function setMSDate($MSDate): void
    {
        $this->MSDate = $MSDate;
    }

    /**
     * @param string|null $Occupation
     */
    public function setOccupation($Occupation): void
    {
        $this->Occupation = $Occupation;
    }

    /**
     * @param string|null $Phone1
     */
    public function setPhone1($Phone1): void
    {
        $this->Phone1 = $Phone1;
    }

    /**
     * @param string|null $Phone2
     */
    public function setPhone2($Phone2): void
    {
        $this->Phone2 = $Phone2;
    }

    /**
     * @param string|null $Phone3
     */
    public function setPhone3($Phone3): void
    {
        $this->Phone3 = $Phone3;
    }

    /**
     * @param int|null $PG_MemberID
     */
    public function setPGMemberID($PG_MemberID): void
    {
        $this->PG_MemberID = $PG_MemberID;
    }

    /**
     * @param int|null $RefAgreementID
     */
    public function setRefAgreementID($RefAgreementID): void
    {
        $this->RefAgreementID = $RefAgreementID;
    }

    /**
     * @param int|null $RefAgreementPriceID
     */
    public function setRefAgreementPriceID($RefAgreementPriceID): void
    {
        $this->RefAgreementPriceID = $RefAgreementPriceID;
    }

    /**
     * @param string|null $RESPID
     */
    public function setRESPID($RESPID): void
    {
        $this->RESPID = $RESPID;
    }

    /**
     * @param string|null $ReDate
     */
    public function setReDate($ReDate): void
    {
        $this->ReDate = $ReDate;
    }

    /**
     * @param string|null $Salesperson
     */
    public function setSalesperson($Salesperson): void
    {
        $this->Salesperson = $Salesperson;
    }

    /**
     * @param string|null $Salesperson2
     */
    public function setSalesperson2($Salesperson2): void
    {
        $this->Salesperson2 = $Salesperson2;
    }

    /**
     * @param string|null $Salesperson3
     */
    public function setSalesperson3($Salesperson3): void
    {
        $this->Salesperson3 = $Salesperson3;
    }

    /**
     * @param string|null $State
     */
    public function setState($State): void
    {
        $this->State = $State;
    }

    /**
     * @param string|null $TermDate
     */
    public function setTermDate($TermDate): void
    {
        $this->TermDate = $TermDate;
    }

    /**
     * @param string|null $Zip
     */
    public function setZip($Zip): void
    {
        $this->Zip = $Zip;
    }
}
