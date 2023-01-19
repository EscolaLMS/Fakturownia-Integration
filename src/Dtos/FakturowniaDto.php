<?php

namespace EscolaLms\FakturowniaIntegration\Dtos;

use EscolaLms\Cart\Models\Order;
use EscolaLms\FakturowniaIntegration\Helpers\TimeHelper;
use Carbon\Carbon;
use EscolaLms\FakturowniaIntegration\Dtos\FakturowniaDtoComponents\Position;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class FakturowniaDto
{
    private ?string $kind;
    private ?string $number = null;
    private ?string $sellDate;
    private ?string $issueDate;
    private ?string $paymentTo;
    private ?float $totalPriceGross = 0.00;
    private ?string $sellerName;
    private ?string $sellerTaxNo;
    private ?string $sellerBankAccount;
    private ?string $sellerBank;
    private ?string $sellerPostCode;
    private ?string $sellerCity;
    private ?string $sellerStreet;
    private ?string $sellerEmail;
    private ?string $buyerName;
    private ?string $buyerEmail;
    private ?string $buyerTaxNo;
    private ?string $buyerCity;
    private ?string $buyerPostCode;
    private ?string $buyerStreet;
    private ?Collection $positions;
    private Carbon $now;

    public function __construct(Order $order)
    {
        if ($order->client_taxid) {
            $name = $order->client_company ?? $order->client_name ?? ($order->user->first_name . " " . $order->user->last_name) ?? '';
        } else {
            $name = $order->client_name ?? $order->client_company ?? ($order->user->first_name . " " . $order->user->last_name) ?? '';
        }
        $this->now = TimeHelper::generateDateObject('now');
        $this->setKind('vat');
        $this->setNumber(null);
        $this->setSellDate($this->now->format('Y-m-d'));
        $this->setIssueDate($this->now->format('Y-m-d'));
        $this->setBuyerEmail($order->client_email ?? $order->user->email ?? null);
        $this->setBuyerName($name ?? null);
        $this->setBuyerTaxNo($order->client_taxid ?? null);
        $this->setBuyerPostCode($order->client_postal ?? null);
        $this->setBuyerCity($order->client_city ?? $order->user->city ?? null);
        $this->setBuyerStreet($order->client_street ? $order->client_street.($order->client_street_number ? (' '.$order->client_street_number) : '') : null);
        $this->setPaymentTo($this->now->format('Y-m-d'));
        $this->setSellerName(Config::get('fakturownia.seller.name', 'Escola'));
        $this->setSellerTaxNo(Config::get('fakturownia.seller.nip', ''));
        $this->setSellerBank(Config::get('fakturownia.seller.bank', ''));
        $this->setSellerBankAccount(Config::get('fakturownia.seller.bank_account', ''));
        $this->setSellerEmail(Config::get('fakturownia.seller.email', ''));
        $this->setSellerStreet(Config::get('fakturownia.seller.street', ''));
        $this->setSellerCity(Config::get('fakturownia.seller.city', ''));
        $this->setSellerPostCode(Config::get('fakturownia.seller.zip_code', ''));
        $this->setPositions($order->items);
    }

    public function setBuyerPostCode(?string $buyerPostCode): void
    {
        $this->buyerPostCode = $buyerPostCode;
    }

    public function getBuyerPostCode(): string
    {
        return $this->buyerPostCode ?? '';
    }

    public function setBuyerCity(?string $buyerCity): void
    {
        $this->buyerCity = $buyerCity;
    }

    public function getBuyerCity(): string
    {
        return $this->buyerCity ?? '';
    }

    public function setBuyerStreet(?string $buyerStreet): void
    {
        $this->buyerStreet = $buyerStreet;
    }

    public function getBuyerStreet(): string
    {
        return $this->buyerStreet ?? '';
    }

    public function getSellerBankAccount(): string
    {
        return $this->sellerBankAccount ?? '';
    }

    public function setSellerBankAccount(?string $sellerBankAccount): void
    {
        $this->sellerBankAccount = $sellerBankAccount;
    }

    public function getSellerBank(): string
    {
        return $this->sellerBank ?? '';
    }

    public function setSellerBank(?string $sellerBank): void
    {
        $this->sellerBank = $sellerBank;
    }

    public function getSellerPostCode(): string
    {
        return $this->sellerPostCode ?? '';
    }

    public function setSellerPostCode(?string $sellerPostCode): void
    {
        $this->sellerPostCode = $sellerPostCode;
    }

    public function getSellerCity(): string
    {
        return $this->sellerCity ?? '';
    }

    public function setSellerCity(?string $sellerCity): void
    {
        $this->sellerCity = $sellerCity;
    }

    public function getSellerStreet(): string
    {
        return $this->sellerStreet ?? '';
    }

    public function setSellerStreet(?string $sellerStreet): void
    {
        $this->sellerStreet = $sellerStreet;
    }

    public function getSellerEmail(): string
    {
        return $this->sellerEmail ?? '';
    }

    public function setSellerEmail(?string $sellerEmail): void
    {
        $this->sellerEmail = $sellerEmail;
    }

    protected function getKind(): string
    {
        return $this->kind ?? '';
    }

    protected function setKind(?string $kind): void
    {
        $this->kind = $kind;
    }

    protected function getNumber(): string
    {
        return $this->number ?? '';
    }

    protected function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    protected function getSellDate(): string
    {
        return $this->sellDate ?? '';
    }

    protected function setSellDate(?string $sellDate): void
    {
        $this->sellDate = $sellDate;
    }

    protected function getIssueDate(): string
    {
        return $this->issueDate ?? '';
    }

    protected function setIssueDate(?string $issueDate): void
    {
        $this->issueDate = $issueDate;
    }

    protected function getPaymentTo(): string
    {
        return $this->paymentTo ?? '';
    }

    protected function setPaymentTo(?string $paymentTo): void
    {
        $this->paymentTo = $paymentTo;
    }

    protected function getSellerName(): string
    {
        return $this->sellerName ?? '';
    }

    protected function setSellerName(?string $sellerName): void
    {
        $this->sellerName = $sellerName;
    }

    protected function getSellerTaxNo(): string
    {
        return $this->sellerTaxNo ?? '';
    }

    protected function setSellerTaxNo(?string $sellerTaxNo): void
    {
        $this->sellerTaxNo = $sellerTaxNo;
    }

    protected function getBuyerName(): string
    {
        return $this->buyerName ?? '';
    }

    protected function setBuyerName(?string $buyerName): void
    {
        $this->buyerName = $buyerName;
    }

    protected function getBuyerEmail(): string
    {
        return $this->buyerEmail ?? '';
    }

    protected function setBuyerEmail(?string $buyerEmail): void
    {
        $this->buyerEmail = $buyerEmail;
    }

    protected function getBuyerTaxNo(): string
    {
        return $this->buyerTaxNo ?? '';
    }

    protected function setBuyerTaxNo(?string $buyerTaxNo): void
    {
        $this->buyerTaxNo = $buyerTaxNo;
    }

    protected function getPositions(): ?Collection
    {
        return $this->positions;
    }

    protected function setPositions(Collection $items): void
    {
        $this->positions = collect();
        foreach ($items as $item) {
            $position = new Position($item);
            $this->totalPriceGross += $item->total_with_tax;
            $this->positions->push($position->prepareData());
        }
    }

    public function getTotalPriceGross() : float
    {
        return $this->totalPriceGross;
    }

    public function prepareData(): array
    {
        return [
            'kind' => $this->getKind(),
            'number' => null,
            'sell_date' => $this->getSellDate(),
            'issue_date' => $this->getIssueDate(),
            'payment_to' => $this->getPaymentTo(),
            'seller_name' => $this->getSellerName(),
            'seller_tax_no' => $this->getSellerTaxNo(),
            'seller_bank_account' => $this->getSellerBankAccount(),
            'seller_bank' => $this->getSellerBank(),
            'seller_post_code' => $this->getSellerPostCode(),
            'seller_city' => $this->getSellerCity(),
            'seller_street' => $this->getSellerStreet(),
            'buyer_name' => $this->getBuyerName(),
            'buyer_city' => $this->getBuyerCity(),
            'buyer_street' => $this->getBuyerStreet(),
            'buyer_post_code' => $this->getBuyerPostCode(),
            'buyer_email' => $this->getBuyerEmail(),
            'buyer_tax_no' => $this->getBuyerTaxNo(),
            'positions' => $this->getPositions()->toArray(),
        ];
    }

}
