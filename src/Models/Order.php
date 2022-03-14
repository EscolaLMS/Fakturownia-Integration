<?php

namespace EscolaLms\FakturowniaIntegration\Models;

use EscolaLms\Cart\Models\Order as OrderCart;
use EscolaLms\Cart\QueryBuilders\OrderModelQueryBuilder;

/**
 * @property int $id
 * @property int|null $user_id
 * @property int $status
 * @property int $total
 * @property int $subtotal
 * @property int $tax
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $client_name
 * @property string|null $client_street
 * @property string|null $client_postal
 * @property string|null $client_city
 * @property string|null $client_country
 * @property string|null $client_company
 * @property string|null $client_taxid
 * @property int|null $invoice_id
 * @property-read int $quantity
 * @property-read string $status_name
 * @property-read \EscolaLms\Cart\Support\OrderItemCollection|\EscolaLms\Cart\Models\OrderItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\EscolaLms\Payments\Models\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \EscolaLms\Cart\Models\User|null $user
 * @method static \EscolaLms\Cart\Database\Factories\OrderFactory factory(...$parameters)
 * @method static OrderModelQueryBuilder|Order newModelQuery()
 * @method static OrderModelQueryBuilder|Order newQuery()
 * @method static OrderModelQueryBuilder|Order query()
 * @method static OrderModelQueryBuilder|Order whereClientCity($value)
 * @method static OrderModelQueryBuilder|Order whereClientCompany($value)
 * @method static OrderModelQueryBuilder|Order whereClientCountry($value)
 * @method static OrderModelQueryBuilder|Order whereClientName($value)
 * @method static OrderModelQueryBuilder|Order whereClientPostal($value)
 * @method static OrderModelQueryBuilder|Order whereClientStreet($value)
 * @method static OrderModelQueryBuilder|Order whereClientTaxid($value)
 * @method static OrderModelQueryBuilder|Order whereCreatedAt($value)
 * @method static OrderModelQueryBuilder|Order whereHasBuyable(string $buyable_type, int $buyable_id)
 * @method static OrderModelQueryBuilder|Order whereHasProduct(int $product_id)
 * @method static OrderModelQueryBuilder|Order whereHasProductable(\Illuminate\Database\Eloquent\Model $productable)
 * @method static OrderModelQueryBuilder|Order whereHasProductableClass(string $productable_type)
 * @method static OrderModelQueryBuilder|Order whereHasProductableClassAndId(string $productable_type, int $productable_id)
 * @method static OrderModelQueryBuilder|Order whereId($value)
 * @method static OrderModelQueryBuilder|Order whereStatus($value)
 * @method static OrderModelQueryBuilder|Order whereSubtotal($value)
 * @method static OrderModelQueryBuilder|Order whereTax($value)
 * @method static OrderModelQueryBuilder|Order whereTotal($value)
 * @method static OrderModelQueryBuilder|Order whereUpdatedAt($value)
 * @method static OrderModelQueryBuilder|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends OrderCart
{
}
