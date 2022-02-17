<?php

namespace Samfelgar\FinnetClient\Invoices\CreateInvoice;

use Spatie\DataTransferObject\DataTransferObject;

class Invoice extends DataTransferObject
{
    public string $ourNumber;
    public ?string $titlePrefix;
    public ?int $walletVariation;
    public ?int $bordereauNumber;
    public ?string $invoiceType;
    public int $bankWalletCode;
    public int $transactionCode;
    public ?string $yourNumber;
    public string $titleDueDate;

    /**
     * @var float|int
     */
    public float $titleAmount;
    public ?int $demandingBankBranch;
    public ?string $demandingBankBranchIdentifier;
    public int $titleType;
    public ?string $acceptance;
    public ?string $titleIssueDate;
    public ?int $firstInstruction;
    public ?int $secondInstruction;

    /**
     * @var float|int|null
     */
    public ?float $latePaymentInterestPerDay;
    public ?string $discountLimitDate;

    /**
     * @var float|int|null
     */
    public ?float $discountAmount;

    /**
     * @var float|int|null
     */
    public ?float $iofAmount;

    /**
     * @var float|int|null
     */
    public ?float $rebateValue;
    public ?string $drawerGuarantorName;
    public ?int $deadlineForProtest;
    public ?int $serviceLot;
    public ?int $recordSeqNumInLot;
    public ?int $sendingMovementCode;
    public ?int $bankBranch;
    public ?string $dacBankBranch;
    public ?string $bankAccount;
    public ?string $dacBankAccount;
    public ?string $dacBankBranchAccount;
    public ?int $titleBankIdentification;
    public ?int $titleFormOfRegistration;
    public ?string $documentType;
    public int $bankSlipEmissionId;
    public string $bankSlipDeliveryId;
    public ?int $billingDocumentNumber;
    public string $identifier;
    public ?string $dacDemandingBankBranch;
    public ?int $latePaymentInterestCode;
    public ?string $latePaymentInterestDate;
    public ?int $discountCode1;
    public ?string $discountLimitDate1;
    public ?int $discountAmount1;

    /**
     * @var float|int|null
     */
    public ?float $iofTaxAmount;
    public ?string $titleIdentificationInCompany;
    public ?int $protestCode;
    public ?int $closeCode;
    public ?int $deadlineForClose;
    public ?int $currencyCode;
    public ?int $contractNumber;
    public ?string $registrationType;
    public ?int $registrationNumber;
    public ?string $drawerGuarantorRegistType;
    public ?int $drawerGuarantorRegistNumber;
    public ?int $correspClearingBankCode;
    public ?int $ourNumberAtCorrespBank;
    public ?int $discountCode2;
    public ?string $discountLimitDate2;

    /**
     * @var float|int|null
     */
    public ?float $discountAmount2;
    public ?int $discountCode3;
    public ?string $discountLimitDate3;

    /**
     * @var float|int|null
     */
    public ?float $discountAmount3;
    public ?string $penaltyCode;
    public ?string $penaltyDate;

    /**
     * @var float|int|null
     */
    public ?float $penaltyValue;
    public ?string $informationToPayer;
    public ?string $message3;
    public ?string $message4;
    public ?int $payerOccurrenceCode;
    public ?int $bankCodeInDebtAccount;
    public ?int $debitBankBranch;
    public ?string $dacDebitBankBranch;
    public ?int $debitBankAccount;
    public ?string $dacDebitBankAccount;
    public ?string $dacDebitBankBranchAccount;
    public ?int $warningForAutomaticDebit;

    /**
     * @var float|int|null
     */
    public ?float $amountPaid;

    /**
     * @var float|int|null
     */
    public ?float $creditAmount;

    /**
     * @var float|int|null
     */
    public ?float $otherExpenditures;

    /**
     * @var float|int|null
     */
    public ?float $otherCredits;
    public ?string $payerOccurrenceDate;
    public ?string $occurrenceComplement;

    /**
     * @var float|int|null
     */
    public ?float $tariffsCostsValues;
    public ?string $occurrenceReason;
    public ?string $creditDate;
    public ?string $occurrenceDate;

    /**
     * @var float|int|null
     */
    public ?float $occurrenceValue;

    public function toArray(): array
    {
        $data = [
            'our_number' => $this->ourNumber,
            'title_prefix' => $this->titlePrefix ?? null,
            'wallet_variation' => $this->walletVariation ?? null,
            'bordereau_number' => $this->bordereauNumber ?? null,
            'invoice_type' => $this->invoiceType ?? null,
            'bank_wallet_code' => $this->bankWalletCode,
            'transaction_code' => $this->transactionCode,
            'your_number' => $this->yourNumber ?? null,
            'title_due_date' => $this->titleDueDate,
            'title_amount' => $this->titleAmount,
            'demanding_bank_branch' => $this->demandingBankBranch ?? null,
            'demanding_bank_branch_identifier' => $this->demandingBankBranchIdentifier ?? null,
            'title_type' => $this->titleType,
            'acceptance' => $this->acceptance ?? null,
            'title_issue_date' => $this->titleIssueDate ?? null,
            'first_instruction' => $this->firstInstruction ?? null,
            'second_instruction' => $this->secondInstruction ?? null,
            'late_payment_interest_per_day' => $this->latePaymentInterestPerDay ?? null,
            'discount_limit_date' => $this->discountLimitDate ?? null,
            'discount_amount' => $this->discountAmount ?? null,
            'iof_amount' => $this->iofAmount ?? null,
            'rebate_value' => $this->rebateValue ?? null,
            'drawer_guarantor_name' => $this->drawerGuarantorName ?? null,
            'deadline_for_protest' => $this->deadlineForProtest ?? null,
            'service_lot' => $this->serviceLot ?? null,
            'record_seq_num_in_lot' => $this->recordSeqNumInLot ?? null,
            'sending_movement_code' => $this->sendingMovementCode ?? null,
            'bank_branch' => $this->bankBranch ?? null,
            'dac_bank_branch' => $this->dacBankBranch ?? null,
            'bank_account' => $this->bankAccount ?? null,
            'dac_bank_account' => $this->dacBankAccount ?? null,
            'dac_bank_branch_account' => $this->dacBankBranchAccount ?? null,
            'title_bank_identification' => $this->titleBankIdentification ?? null,
            'title_form_of_registration' => $this->titleFormOfRegistration ?? null,
            'document_type' => $this->documentType ?? null,
            'bank_slip_emission_id' => $this->bankSlipEmissionId,
            'bank_slip_delivery_id' => $this->bankSlipDeliveryId,
            'billing_document_number' => $this->billingDocumentNumber ?? null,
            'identifier' => $this->identifier,
            'dac_demanding_bank_branch' => $this->dacDemandingBankBranch ?? null,
            'late_payment_interest_code' => $this->latePaymentInterestCode ?? null,
            'late_payment_interest_date' => $this->latePaymentInterestDate ?? null,
            'discount_code_1' => $this->discountCode1 ?? null,
            'discount_limit_date_1' => $this->discountLimitDate1 ?? null,
            'discount_amount_1' => $this->discountAmount1 ?? null,
            'iof_tax_amount' => $this->iofTaxAmount ?? null,
            'title_identification_in_company' => $this->titleIdentificationInCompany ?? null,
            'protest_code' => $this->protestCode ?? null,
            'close_code' => $this->closeCode ?? null,
            'deadline_for_close' => $this->deadlineForClose ?? null,
            'currency_code' => $this->currencyCode ?? null,
            'contract_number' => $this->contractNumber ?? null,
            'registration_type' => $this->registrationType ?? null,
            'registration_number' => $this->registrationNumber ?? null,
            'drawer_guarantor_regist_type' => $this->drawerGuarantorRegistType ?? null,
            'drawer_guarantor_regist_number' => $this->drawerGuarantorRegistNumber ?? null,
            'corresp_clearing_bank_code' => $this->correspClearingBankCode ?? null,
            'our_number_at_corresp_bank' => $this->ourNumberAtCorrespBank ?? null,
            'discount_code_2' => $this->discountCode2 ?? null,
            'discount_limit_date_2' => $this->discountLimitDate2 ?? null,
            'discount_amount_2' => $this->discountAmount2 ?? null,
            'discount_code_3' => $this->discountCode3 ?? null,
            'discount_limit_date_3' => $this->discountLimitDate3 ?? null,
            'discount_amount_3' => $this->discountAmount3 ?? null,
            'penalty_code' => $this->penaltyCode ?? null,
            'penalty_date' => $this->penaltyDate ?? null,
            'penalty_value' => $this->penaltyValue ?? null,
            'information_to_payer' => $this->informationToPayer ?? null,
            'message_3' => $this->message3 ?? null,
            'message_4' => $this->message4 ?? null,
            'payer_occurrence_code' => $this->payerOccurrenceCode ?? null,
            'bank_code_in_debt_account' => $this->bankCodeInDebtAccount ?? null,
            'debit_bank_branch' => $this->debitBankBranch ?? null,
            'dac_debit_bank_branch' => $this->dacDebitBankBranch ?? null,
            'debit_bank_account' => $this->debitBankAccount ?? null,
            'dac_debit_bank_account' => $this->dacDebitBankAccount ?? null,
            'dac_debit_bank_branch_account' => $this->dacDebitBankBranchAccount ?? null,
            'warning_for_automatic_debit' => $this->warningForAutomaticDebit ?? null,
            'amount_paid' => $this->amountPaid ?? null,
            'credit_amount' => $this->creditAmount ?? null,
            'other_expenditures' => $this->otherExpenditures ?? null,
            'other_credits' => $this->otherCredits ?? null,
            'payer_occurrence_date' => $this->payerOccurrenceDate ?? null,
            'occurrence_complement' => $this->occurrenceComplement ?? null,
            'tariffs_costs_values' => $this->tariffsCostsValues ?? null,
            'occurrence_reason' => $this->occurrenceReason ?? null,
            'credit_date' => $this->creditDate ?? null,
            'occurrence_date' => $this->occurrenceDate ?? null,
            'occurrence_value' => $this->occurrenceValue ?? null,
        ];

        return array_filter($data, fn($value) => $value !== null);
    }
}