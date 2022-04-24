<?php

namespace App\Orchid\Screens;

use App\Models\Group;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProductEditScreen extends Screen
{
    private string $name = 'Создать товар';
    private bool $exists = false;

    public function query(Product $product): iterable
    {
        if ($product->exists) {
            $this->exists = true;
            $this->name = 'Редактировать товар';
        }

        return [
            'product' => $product,
        ];
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function commandBar(): iterable
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Вы уверены что хотите удалить товар?'))
                ->method('remove')
                ->canSee($this->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save')
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::tabs([
                'Основное' => Layout::rows([
                    Select::make('product.group_id')
                        ->fromModel(Group::class, 'name')
                        ->empty('No select')
                        ->title('Группа товара'),

                    \Orchid\Screen\Fields\Group::make([
                        Input::make('product.name')
                            ->type('text')
                            ->max(255)
                            ->required()
                            ->title('Название товара')
                            ->placeholder('Название товара'),

                        Input::make('product.sort')
                            ->type('number')
                            ->required()
                            ->title('Сортировка')
                            ->placeholder('Сортировка'),
                    ]),
                    Matrix::make('product.setting.attributes')
                        ->columns([
                            'Аттрибут' => 'text',
                        ])->title('Аттрибуты по умолчанию'),

                    Matrix::make('product.setting.prices')
                        ->columns([
                            'Опция' => 'name',
                            'Цена' => 'price',
                            'Аттрибут - каждый с новой строки' => 'text'
                        ])->fields([
                            'name' => Input::make()->type('text')->style('height: 80px!important;'),
                            'price' => Input::make()->type('number')->style('height: 80px!important;'),
                            'text' => TextArea::make()->rows(5)->style('height: 80px!important;'),
                        ])->title('Цены товара'),
                ]),
                'Медиа' => Layout::rows([
                    Upload::make('product.attachment')
                        ->groups('photo')
                ]),
            ]),
        ];
    }

    public function save(Request $request, Product $product): \Illuminate\Http\RedirectResponse
    {
        $request_data = $request->validate([
            'product.name' => [
                'required',
                'max:255',
            ],
            'product.sort' => [
                'nullable',
                'integer',
            ],
            'product.group_id' => [
                'nullable',
                Rule::exists(Group::class, 'id'),
            ],
            'product.setting' => [
                'nullable',
                'array'
            ]
        ])['product'];

        if (empty($request_data['sort'])) {
            $request_data['sort'] = 0;
        }

        if (empty($request_data['setting'])) {
            $request_data['setting'] = [];
        }

        $request_data['setting']['attributes'] = array_values($request_data['setting']['attributes'] ?? []);
        $request_data['setting']['prices'] = array_values($request_data['setting']['prices'] ?? []);

        $product->fill($request_data)->save();

        $product->attachment()->syncWithoutDetaching(
            $request->input('product.attachment', [])
        );

        Toast::info('Группа успешно сохранена!');

        return redirect()->route('platform.products');
    }
}
