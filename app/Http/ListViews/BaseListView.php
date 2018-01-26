<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 24.1.2018 г.
 * Time: 16:57
 */

namespace App\Http\ListViews;

use FlowControl\ListView\ListView;

class BaseListView extends ListView
{
    public function __construct($dataSource)
    {
        $this->setRequest(request());

        parent::__construct($dataSource);

        $this->render = 'vue';
        $this->class = 'table table-bordered table-hover table-striped';
    }
}