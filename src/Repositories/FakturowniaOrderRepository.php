<?php

namespace EscolaLms\FakturowniaIntegration\Repositories;

use EscolaLms\Core\Repositories\BaseRepository;
use EscolaLms\FakturowniaIntegration\Models\FakturowniaOrder;
use EscolaLms\FakturowniaIntegration\Repositories\Contracts\FakturowniaOrderRepositoryContract;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class FakturowniaOrderRepository extends BaseRepository implements FakturowniaOrderRepositoryContract
{
   protected $fieldSearchable = [
        'order_id',
        'fakturownia_id',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return FakturowniaOrder::class;
    }

    public function getActive(): Collection
    {
        return $this->model->newQuery()->get();
    }

    /**
     * @throws ModelNotFoundException
     */
    public function getFirstFakturowniaOrderByOrderId(int $orderId): ?FakturowniaOrder
    {
        return $this->model->newQuery()->where('order_id', '=', $orderId)->first();
    }

    public function setFakturowniaIdToOrder(int $orderId, int $fakturowniaId): FakturowniaOrder
    {
        return $this->model->newQuery()->where([
            ['order_id', '=', $orderId],
            ['fakturownia_id', '=', $fakturowniaId]
        ])->firstOrNew();
    }
}
