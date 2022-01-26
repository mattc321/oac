<?php

namespace App\Api\MotionSoft\Model;

class MemberModel
{
    /**
     * @var string|null
     */
    private $Acctnote;
    /**
     * @var string|null
     */
    private $Address1;
    /**
     * @var string|null
     */
    private $Address2;
    /**
     * @var bool|null
     */
    private $AutoBill;
    /**
     * @var string|null
     */
    private $Barcode;
    /**
     * @var string|null
     */
    private $Birthday;
    /**
     * @var string|null
     */
    private $City;
    /**
     * @var string|null
     */
    private $Company;
    /**
     * @var bool|null
     */
    private $DoNotSendTextMessages;
    /**
     * @var bool|null
     */
    private $DoNotEmail;
    /**
     * @var string|null
     */
    private $DriveLic;
    /**
     * @var string|null
     */
    private $EnteredDate;
    /**
     * @var string|null
     */
    private $Email;
    /**
     * @var string|null
     */
    private $Emercon;
    /**
     * @var string|null
     */
    private $EmerExt;
    /**
     * @var string|null
     */
    private $EmerPhone;
    /**
     * @var string|null
     */
    private $FirstName;
    /**
     * @var string|null
     */
    private $FirstBillDate;
    /**
     * @var string|null
     */
    private $FreezeEndDate;
    /**
     * @var string|null
     */
    private $FreezeStartDate;
    /**
     * @var string|null
     */
    private $Gender;
    /**
     * @var string|null
     */
    private $HomeClub;
    /**
     * @var string|null
     */
    private $ID;
    /**
     * @var string|null
     */
    private $LastName;
    /**
     * @var string|null
     */
    private $Source;
    /**
     * @var string|null
     */
    private $Membership_Type;
    /**
     * @var string|null
     */
    private $MemberStatus;
    /**
     * @var string|null
     */
    private $Memo;
    /**
     * @var string|null
     */
    private $MSDate;
    /**
     * @var string|null
     */
    private $Occupation;
    /**
     * @var string|null
     */
    private $Phone1;
    /**
     * @var string|null
     */
    private $Phone2;
    /**
     * @var string|null
     */
    private $Phone3;
    /**
     * @var int|null
     */
    private $PG_MemberID;
    /**
     * @var int|null
     */
    private $RefAgreementID;
    /**
     * @var int|null
     */
    private $RefAgreementPriceID;
    /**
     * @var string|null
     */
    private $RESPID;
    /**
     * @var string|null
     */
    private $ReDate;
    /**
     * @var string|null
     */
    private $Salesperson;
    /**
     * @var string|null
     */
    private $Salesperson2;
    /**
     * @var string|null
     */
    private $Salesperson3;
    /**
     * @var string|null
     */
    private $State;
    /**
     * @var string|null
     */
    private $TermDate;
    /**
     * @var string|null
     */
    private $Zip;

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
}
