<?php

namespace App\DataTables;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('date', function ($query) {
                return date('d-M-y', strtotime($query->created_at));
            })
            ->addColumn('invoice_id', function ($query) {
                return $query->order->invoice_id;
            })
            ->addColumn('paid_from', function ($query) {
                if ($query->payment_method == 'bkash') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1656234745bkash-app-logo-png.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>" . $query->payment_id . "</span>";
                } elseif ($query->payment_method == 'Nagad') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>" . $query->payment_id . "</span>";
                } elseif ($query->payment_method == 'Rocket') {
                    return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>" . $query->payment_id . "</span>";
                } elseif ($query->payment_method == 'nagad') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>" . $query->payment_id . "</span>";
                } elseif ($query->payment_method == 'rocket') {
                    return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>" . $query->payment_id . "</span>";
                } else {
                    return $query->payment_id;
                }
            })
            ->addColumn('paid_to', function ($query) {
                if ($query->paid_to) {
                    if ($query->payment_method == 'bkash') {
                        return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1656234745bkash-app-logo-png.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>" . $query->paid_to . "</span>";
                    } elseif ($query->payment_method == 'Nagad') {
                        return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>" . $query->paid_to . "</span>";
                    } elseif ($query->payment_method == 'Rocket') {
                        return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>" . $query->paid_to . "</span>";
                    } elseif ($query->payment_method == 'nagad') {
                        return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>" . $query->paid_to . "</span>";
                    } elseif ($query->payment_method == 'rocket') {
                        return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>" . $query->paid_to . "</span>";
                    } else {
                        return $query->paid_to;
                    }
                } elseif ($query->payment_method == 'bkash') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1656234745bkash-app-logo-png.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>01886599351</span>";
                } elseif ($query->payment_method == 'Nagad') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>01886599351</span>";
                } elseif ($query->payment_method == 'Rocket') {
                    return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>019608002209</span>";
                } elseif ($query->payment_method == 'nagad') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>01886599351</span>";
                } elseif ($query->payment_method == 'rocket') {
                    return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>019608002209</span>";
                }
            })
            ->addColumn('payment_status', function ($query) {
                if ($query->order->payment_status == 'pending') {
                    return "<span class= 'badge bg-warning' style='width:80px; color: black;'>" . $query->order->payment_status . "</span>";
                } elseif ($query->order->payment_status == 'partial') {
                    return "<span class= 'badge bg-info' style='width:80px; color: black;'>" . $query->order->payment_status . "</span>";
                } elseif ($query->order->payment_status == 'approved') {
                    return "<span class= 'badge bg-success' style='width:80px; color: black;'>" . $query->order->payment_status . "</span>";
                } else {
                    return "<span class= 'badge bg-danger' style='width:80px; color: black;'>" . $query->order->payment_status . "</span>";
                }
            })
            ->filterColumn('invoice_id', function ($query, $keyword) {
                $query->whereHas('order', function ($query) use ($keyword) {
                    $query->where('invoice_id', 'like', "%$keyword%");
                });
            })
            ->rawColumns(['date', 'payment_status', 'paid_from', 'paid_to'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Transaction $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('transaction-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->addClass('text-center'),
            Column::make('invoice_id')->addClass('text-center'),
            Column::make('paid_to'),
            Column::make('paid_from'),
            Column::make('transaction_id')->addClass('text-center'),
            Column::make('amount')->addClass('text-center'),
            Column::make('currency')->addClass('text-center'),
            Column::make('payment_status')->addClass('text-center'),
            Column::make('date')->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Transaction_' . date('YmdHis');
    }
}
