<?php

namespace App\DataTables;

use App\Models\Question;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class QuestionDataTable extends DataTable
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
            ->addColumn('action', function ($data) {
                return "<a href='".url("control-panel/questions/$data->id")."' class='btn btn-primary btn-sm btn-block'>Detail</a>";
            })
            ->editColumn('text_question', function($data){
                return substr($data->text_question, 0, 20);
            })
            ->editColumn('selection', function($data){
                return $data->selection->code_group_question;
            })
            ->editColumn('test', function($data){
                return $data->test->code_sub_group_question;
            })
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\QuestionDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $question = Question::select();
        return $this->applyScopes($question);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('questiondatatable-table')
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
            Column::make('id')->visible(false),
            Column::make('sub_test'),
            Column::make('text_question'),
            Column::make('selection')->orderable(false),
            Column::make('test')->orderable(false),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Question_' . date('YmdHis');
    }
}
