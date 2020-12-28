<?php

namespace App\DataTables;

use App\Models\Exam;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ExamsDataTable extends DataTable
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
            ->addColumn('action', function ($data){
                return "<a href='".url("control-panel/exams/$data->id")."' class='btn btn-primary btn-sm btn-block'>Detail</a>";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ExamsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Exam $model)
    {
        return $this->applyScopes(Exam::select());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('examsdatatable-table')
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
            Column::make('code_exam')->title('Kode Ujian'),
            Column::make('package_exam')->title('Paket Ujian'),
            Column::make('group_question_id')->title('Seleksi'),
            Column::make('sub_group_question_id')->title('Tes'),
            Column::make('number_of_question')->title('Soal'),
            Column::make('test_result')->title('Hasil'),
            Column::make('duration_exam')->title('Durasi'),
            Column::make('user_id')->title('Peserta'),
            Column::make('created_at')->title('Tanggal'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Exams_' . date('YmdHis');
    }
}
