<?php

namespace App\Orchid\Screens;

use App\Models\Product;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class ProductScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'products' => Product::filters()->defaultSort('sort', 'asc')->get()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список товаров';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.products.create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('products', [
                TD::make('group', 'Группа')
                    ->sort()
                    ->cantHide()
                    ->render(function (Product $product) {
                        return $product->group?->name ?? '-';
                    }),

                TD::make('name', 'Товар')
                    ->sort()
                    ->cantHide()
                    ->render(function (Product $product) {
                        return $product->name;
                    }),

                TD::make('sort', 'Сортировка')
                    ->sort()
                    ->cantHide()
                    ->render(function (Product $product) {
                        return $product->sort;
                    }),

                TD::make('updated_at', __('Last edit'))
                    ->sort()
                    ->render(function (Product $product) {
                        return $product->updated_at->toDateTimeString();
                    }),

                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (Product $product) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make(__('Edit'))
                                    ->route('platform.products.edit', $product->id)
                                    ->icon('pencil'),

                                Button::make('Удалить')
                                    ->icon('trash')
                                    ->confirm('Вы уверены что хотите удалить группу товара?')
                                    ->method('remove', [
                                        'id' => $product->id,
                                    ]),
                            ]);
                    }),
            ]),
        ];
    }
}
