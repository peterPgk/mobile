<?php

/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 24.1.2018 г.
 * Time: 09:01
 */

namespace App\Http\ListViews;

use App\Phone;
use FlowControl\ListView\Columns\Action;
use FlowControl\ListView\Columns\Actions;
use FlowControl\ListView\Columns\Column;

class PhonesListView extends BaseListView
{

    protected function columns()
    {
        $this
            ->text('id', '#', ['sortable' => true])
            ->text('name', 'Name', ['sortable' => true])
            ->boolean('available', '', [
                function(Column $column) {
                    $column->format(function (array $row) {
                        return (bool) !$row['available'];
                    });
                },
                'sortable' => true,
                'visible' => false
            ])
            ->html('is_available', 'Available', [
                function(Column $column) {
                    $column->format(function (array $row) {
                        return (bool) $row['available'];
                    }, 'yesno');
                },
                'sortable' => true
            ])
            ->text('accessories', 'accessories', [
                function (Column $column) {
                    $column->format(function (array $row) {
                        return Phone::withCount('accessories')->find($row['id'])->accessories_count;
                    });
                },
                'sortable' => true
            ])
            ->actions('', function(Actions $actions) {
                $actions
                    ->action('add', 'Add')
                    ->icon('fa fa-plus')
                    ->url( route('phone.create') )
                    ->setGlobal();

                $actions
                    ->action('edit', 'Edit')
                    ->icon('fa fa-edit')
                    ->define(function(Action $action, array $row){
                        $action->url( route('phone.edit', [$row['id']]) );
                    });

                $actions
                    ->action('toggle_available', 'Toggle Available')
                    ->icon('fa fa-trash')
                    ->set('tooltip', 'Show/hide available records')
                    ->setFilter('available');

            });
    }
}