<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 24.1.2018 г.
 * Time: 09:17
 */

namespace App\Http\ListViews;

use FlowControl\ListView\Columns\Action;
use FlowControl\ListView\Columns\Actions;
use FlowControl\ListView\Columns\Column;

class AccessoriesListView extends BaseListView
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
            ->actions('', function(Actions $actions) {
                $actions
                    ->action('add', 'Add')
                    ->icon('fa fa-plus')
                    ->url( route('accessory.create') )
                    ->setGlobal();

                $actions
                    ->action('edit', 'Edit')
                    ->icon('fa fa-edit')
                    ->define(function(Action $action, array $row){
                        $action->url( route('accessory.edit', [$row['id']]) );
                    });

                $actions
                    ->action('toggle_available', 'Toggle Available')
                    ->icon('fa fa-trash')
                    ->set('tooltip', 'Show/hide available records')
                    ->setFilter('available');

            });
    }
}