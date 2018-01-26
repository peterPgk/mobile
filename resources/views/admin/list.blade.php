@if($list && $list->getOption('render') && $list->getOption('render') === 'vue')
    @include('admin.partials._vue-list')
@else
    @include('admin.partials._php-list')
@endif