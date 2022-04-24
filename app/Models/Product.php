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

    public function scopeAttributesCollection()
    {
        return collect($this->setting['attributes'] ?? [])->map(function ($item) {
            return $item['text'];
        })->filter(fn($item) => (bool)str_replace(' ', '', $item));
    }

    public function scopePricesCollection()
    {
        return collect($this->setting['prices'] ?? [])->map(function ($item) {
            $item = (object)$item;
            $item->price = $item->price . ' руб.';

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
}
