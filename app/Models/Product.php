<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    protected $fillable = [
        'group_id',
        'name',
        'setting',
        'sort',
    ];

    protected $casts = [
        'setting' => 'array',
    ];

    protected $allowedFilters = [
        'id',
        'group_id',
        'name',
        'sort',
        'updated_at',
        'created_at',
    ];

    protected $allowedSorts = [
        'id',
        'group_id',
        'name',
        'sort',
        'updated_at',
        'created_at',
    ];

    public function group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function attributesCollection()
    {
        return collect($this->setting['attributes'] ?? [])->map(function ($item) {
            return $item['text'];
        })->filter(fn($item) => (bool)str_replace(' ', '', $item));
    }

    public function pricesCollection()
    {
        $main_price = str($this->setting['main_price'] ?? '')->trim(' ')->upper()->toString();

        return collect($this->setting['prices'] ?? [])->map(function ($item) use ($main_price) {
            $item = (object)$item;
            $item->price = $item->price . ' руб.';

            if ($item->name) {
                $name = str($item->name)->trim(' ')->upper()->toString();
                $item->checked = $name === $main_price;
            }

            if ($item->text) {
                $item->text = collect(explode(PHP_EOL, $item->text))
                    ->map(fn($text) => trim($text))
                    ->filter(fn($text) => (bool)str_replace(' ', '', $text))
                    ->join(', ');
            } else {
                $item->text = '';
            }

            return $item;
        });
    }

    public function priceFirst()
    {
        $prices = $this->pricesCollection();

        if ($this->setting['main_price'] ?? '') {
            $mainPrices = $prices->first(function ($value) {
                return $value->checked;
            });

            if ($mainPrices) {
                return $mainPrices;
            }
        }

        return $prices->first();
    }

    public function mainPrice()
    {
        return $this->setting['main_price'] ?? '';
    }
}
