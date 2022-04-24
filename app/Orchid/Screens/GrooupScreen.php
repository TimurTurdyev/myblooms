<?php

namespace App\Orchid\Screens;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class GrooupScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'groups' => Group::filters()->defaultSort('sort', 'asc')->get()
        ];
    }

    public function name(): ?string
    {
        return 'Список групп товаров';
    }

    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('add')
                ->modal('asyncAddGroupModal')
                ->icon('plus')
                ->modalTitle('Редактировать')
                ->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('groups', [
                TD::make('name', 'Название группы')
                    ->sort()
                    ->cantHide()
                    ->render(function (Group $group) {
                        return $group->name;
                    }),

                TD::make('sort', 'Сортировка')
                    ->sort()
                    ->cantHide()
                    ->render(function (Group $group) {
                        return $group->sort;
                    }),

                TD::make('updated_at', __('Last edit'))
                    ->sort()
                    ->render(function (Group $group) {
                        return $group->updated_at->toDateTimeString();
                    }),

                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (Group $group) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([

                                ModalToggle::make('Редактировать')
                                    ->modal('asyncEditGroupModal')
                                    ->icon('pencil')
                                    ->modalTitle('Редактировать')
                                    ->method('save')
                                    ->asyncParameters([
                                        'group' => $group->id,
                                    ]),

                                Button::make('Удалить')
                                    ->icon('trash')
                                    ->confirm('Вы уверены что хотите удалить группу товара?')
                                    ->method('remove', [
                                        'id' => $group->id,
                                    ]),
                            ]);
                    }),
            ]),

            Layout::modal('asyncAddGroupModal', Layout::rows($this->getModalFields())),
            Layout::modal('asyncEditGroupModal', Layout::rows($this->getModalFields()))
                ->async('asyncGetGroup')
        ];
    }

    private function getModalFields(): array
    {
        return [
            Input::make('group.name')
                ->type('text')
                ->max(96)
                ->required()
                ->title('Название группы')
                ->placeholder('Название группы'),

            Input::make('group.sort')
                ->type('number')
                ->required()
                ->title('Сортировка')
                ->placeholder('Сортировка'),
        ];
    }

    public function asyncGetGroup(Group $group): iterable
    {
        return [
            'group' => $group,
        ];
    }

    public function save(Request $request, Group $group): void
    {
        $request_data = $request->validate([
            'group.name' => [
                'required',
                Rule::unique(Group::class, 'name')->ignore($group),
            ],
            'group.sort' => [
                'nullable',
                'integer',
            ]
        ])['group'];

        if (empty($request_data['sort'])) {
            $request_data['sort'] = 0;
        }

        $group->fill($request_data)->save();

        Toast::info('Группа успешно сохранена!');
    }

    public function remove(Group $group): void
    {
        $group->delete();

        Toast::info(__('Группа успешно удалена!'));
    }
}
