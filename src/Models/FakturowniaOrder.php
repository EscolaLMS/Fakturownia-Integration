<?php

namespace EscolaLms\FakturowniaIntegration\Models;

use EscolaLms\Cart\Models\Order;
use EscolaLms\FakturowniaIntegration\Database\Factories\FakturowniaOrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\FakturowniaOrder
 *
 * @property int $fakturownia_id
 * @property int $order_id
 * @property-read Order|null $order
 * @method static Builder|FakturowniaOrder newModelQuery()
 * @method static Builder|FakturowniaOrder newQuery()
 * @method static Builder|FakturowniaOrder query()
 * @method static Builder|FakturowniaOrder whereInvoiceId($value)
 * @method static Builder|FakturowniaOrder whereOrderId($value)
 * @mixin \Eloquent
 */
class FakturowniaOrder extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'fakturownia-orders';

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    protected static function newFactory(): FakturowniaOrderFactory
    {
        return FakturowniaOrderFactory::new();
    }
}
