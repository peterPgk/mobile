@if($showLabel && $showField)
    @if($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!} >
    @endif
@endif

    @if($showLabel && $options['label'] !== false && $options['label_show'])
        {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
    @endif

    {{--@if($showField)--}}
        <div id="vue-multiple-{{$options['real_name']}}">
            <multiselect v-model="value"
                         :multiple="true"
                         :options="{{ $options['choices'] }}"
                         track-by="id"
                         :block-keys="['Tab']"
                         label="{{ $options['property'] }}"

            ></multiselect>
            <input type="hidden" name="{{ $options['real_name'] }}" :value="inputValue">
        </div>

        @include('forms.help_block')
    {{--@endif--}}

    @include('forms.errors')

@if($showLabel && $showField)
    @if($options['wrapper'] !== false)
        </div>
    @endif
@endif

@section('scripts')
    <script>

        new Vue({
            el: "#vue-multiple-{{$options['real_name']}}",
            data: function () {
                return {
                    value: {!! $options['selected'] !!},
                    options: null,
                    propertySubmit: '{{$options["property_submit"] ?: 'id'}}'
                }
            },
            computed: {
                inputValue: function () {
                    let ids = _.map(this.value, this.propertySubmit);
                    return JSON.stringify(ids);
                }
            },
        });
    </script>
@append
