@extends('layouts.admin')

@section('content')
    <div class="row" xmlns:v-bind="http://www.w3.org/1999/XSL/Transform">
        <div class="col-xs-12">
            <div class="box">
                <div id="vlistview" class="p-2" v-cloak>
                    <div class="box-header">
                        <h3 class="box-title">{{ $title or '' }}</h3>

                        <div class="box-tools">
                            <template v-for="action in global_actions">

                                <button
                                        v-if="_.has(action, 'isFilter')"
                                        @click="performFilter(action)"
                                        data-toggle="button"
                                        class="btn"
                                        :class="{active: appliedFilters[action.isFilter]}"
                                ><span class="fontDefault"> @{{ action.label }}</span></button>

                                <a v-else
                                        :href="action.url"
                                        class="btn btn-default"
                                        :class="action.icon"
                                ><span class="fontDefault"> @{{ action.label }}</span></a>

                            </template>
                        </div>
                    </div>

                    <v-client-table :data="_listData" :columns="_columns" :options="options" name="listView">

                        <template v-for="column in htmlType" v-bind:slot="column" slot-scope="props">
                            <span v-html="props.row[column]"></span></p>
                        </template>

                        <template v-if="actionsType" slot="actions" slot-scope="props">
                            <template v-for="action in props.row.actions">

                                <button v-if="_.has(action, 'ajax')"
                                        class="btn btn-default"
                                        :class="action.icon"
                                        @click="performAjax(action)"
                                ><span class="fontDefault"> @{{ action.label }}</span></button>

                                <a v-if="!_.has(action, 'ajax')"
                                        :href="action.url"
                                        class="btn btn-default"
                                        :class="action.icon"
                                ><span class="fontDefault"> @{{ action.label }}</span></a>

                            </template>
                        </template>

                    </v-client-table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop

@section('scripts')

    <script>
        new Vue({
            el: '#vlistview',
            data: {
                raw_data: (function (listValues) {return listValues}({!! $list->getFormattedValues() !!})),
                raw_data: JSON.parse("{!! addslashes($list->getFormattedValues()) !!}"),
                raw_columns: (function (columns) {return columns}({!! $list->getFormattedColumns() !!})),
                global_actions: (function (global) {return global}({!! $list->getFormattedActions('global') !!})),
                settings: (function (settings) {return settings}({!! $list->getSettings() !!})),
                /**
                 * колоните по които се прилагат on/off филтри : дали е приложен или не
                 * @returns {_.Dictionary<boolean>}
                 */
                filterProps: {}
            },

            computed: {
                _listData: function () {
                    return this.raw_data;
                },
                _columns_options: function () {
                    return _.mapValues(this.raw_columns, 'options');
                },
                _columns: function () {
                    return _.keys(_.pickBy(this._columns_options, function(column) {
                        return !_.has(column, 'visible') || !!column.visible === true
                    }));
                },
                actionsType: function () {
                    return _.keys(_.pickBy(this.raw_columns, _.matches({type: 'actions'})));
                },
                htmlType: function () {
                    return _.keys(_.pickBy(this.raw_columns, _.matches({type: 'html'})));
                },
                /**
                 * В момента ги генерирам в php поради columnClasses - не се извлича правилно
                 */
                sortableColumns: function () {
                    // return _.keys(_.pickBy(this._columns_options, 'sortable'));
                    return _.has(this.settings, 'sortable') ? _.keys(this.settings.sortable) : []
                },
                filterableColumns: function () {
                    // return _.keys(_.pickBy(this._columns_options, 'filterable'));
                    return _.has(this.settings, 'filterable') ? _.keys(this.settings.filterable) : []
                },
                markableColumns: function () {
                    // return _.mapValues(this._columns_options, 'mark')
                    // return _.mapValues(_.pickBy(this._columns_options, 'mark'), 'mark');
                    return _.has(this.settings, 'markable') ? this.settings.markable : {}
                },
                columnsClasses: function () {
                    // return _.mapValues(this._columns_options, 'columnsClasses')
                    return _.has(this.settings, 'columnsClasses') ? this.settings.columnsClasses : {}
                },
                headings: function () {
                    return _.has(this.settings, 'headings') ? this.settings.headings : [];
                },
                appliedFilters: function () {
                    return _.pickBy(this.filterProps, _.identity);
                },
                options: function () {
                    return {
                        headings: this.headings,
                        sortIcon: { base:'fa', up:'fa-sort-asc', down:'fa-sort-desc', is:'fa-sort' },
                        sortable: this.sortableColumns,
                        filterable: this.filterableColumns,
                        columnsClasses: this.columnsClasses,
                        orderBy: {
                          //TODO
                          column: 'id'
                        },
                        customFilters: [{
                            name: 'toggleFilter',
                            callback: function (row, query) {
                                return !_.some(this.appliedFilters, function (isApplied, filter) {
                                    return row[filter] === true;
                                });
                            }.bind(this)
                        }],
                        rowClassCallback: function (row) {
                            let row_classes = [];
                            _.forEach(this.markableColumns, function (value, key) {
                                if( row[key] !== false ) {
                                    row_classes.push(value);
                                }
                            });
                            return row_classes.join(' ');
                        }.bind(this)
                    }
                }
            },

            methods: {
                performAjax: function(action) {
                    this
                        .$http[action.ajax](action.url)
                        .then(function (response) {
                            this.raw_data = response.data;
                            this.notify(action.messages, 'success');

                        }.bind(this))
                        .catch(function (error) {
                            this.notify(action.messages, 'danger');
                            console.log(error);
                        }.bind(this))
                },

                performFilter: function (action) {
                    if(_.has(this.raw_columns, action.isFilter) && _.has(this.filterProps, action.isFilter)) {
                        this.filterProps[action.isFilter] = !this.filterProps[action.isFilter];
                        _Event.$emit('vue-tables.listView.filter::toggleFilter', action.isFilter);
                    }
                },

                toggleFilters: function () {
                    _.forEach(this.appliedFilters, function (isApplied, filter) {
                        _Event.$emit('vue-tables.listView.filter::toggleFilter', filter);
                    })
                },

                notify: function (message, type) {
                    type = '' + type;
                    if( _.has(message, type) ) {
                        notify(message[type], type);
                    }
                    else {
                        notify(_.upperFirst(type), type);
                    }
                }
            },

            created: function () {
                this.filterProps = _.mapValues(_.keyBy(_.pickBy(this.global_actions, 'isFilter'), 'isFilter'), 'isFilterApplied');
                // this.filterProps = _.mapValues(_.pickBy(this.global_actions, 'isFilter'), 'isFilterApplied');
            },

            mounted: function () {
                this.toggleFilters();
            }
        })
    </script>

@endsection