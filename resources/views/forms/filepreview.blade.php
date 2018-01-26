@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!} >
    @endif
@endif

@if ($showLabel && $options['label'] !== false && $options['label_show'])
   {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
@endif

@if ($showField)
    @if(array_key_exists('prop', $options) && !is_null($options['prop']) )
        <div class="row">
            <div {!! Html::attributes($options['file_wrapper_attr']) !!}>
                {!! Html::link($options['prop']['path'], $options['prop']['name'], $options['file_attr'] ) !!}
            </div>
            {!! Form::button('Delete', ['type' => 'submit', 'name' => 'files_remove[' .$options['prop']['id'] .']', 'value' => 1]) !!}
            {{--{!! Form::hidden('files_remove['. $options['prop']['id'] .']', 1) !!}--}}
        </div>
    @endif

    <div{!! Html::attributes($options['field_wrapper_attr']) !!}>
        {!! Form::input('file', $name, null, $options['attr']) !!}
    </div>

        @include('forms.help_block')
@endif

    @include('forms.errors')

@if ($showLabel && $showField)
    @if ($options['wrapper'] !== false)
        </div>
    @endif
@endif