<?php

namespace App\DataTables;

use App\Models\Test;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GroupTestDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('selection', function($data){
                return $data->group_question_id == null ? "" : $data->selection->code_group_question;
            })
            ->addColumn('action', function ($data) {
                return "<a href='".url("control-panel/test/$data->id")."' class='btn btn-primary btn-sm btn-block'>Detail</a>";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\GroupTestDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $test = Test::select()->orderBy('created_at', 'DESC');
        return $this->applyScopes($test);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('grouptestdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('code_sub_group_question')
                ->title('Kode Tes'),
            Column::make('name_sub_group_question')
                ->title('Nama Tes'),
            Column::make('passing_grade')
                ->title('Passing Grade'),
            Column::computed('selection'),
            Column::make('created_at')
                ->title('Dibuat Pada')

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'GroupTest_' . date('YmdHis');
    }
}
