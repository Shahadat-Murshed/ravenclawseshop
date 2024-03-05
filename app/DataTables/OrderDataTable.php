<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{

    protected $region;

    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }
    public function setOrderStatus($order_status)
    {
        $this->order_status = $order_status;
        return $this;
    }
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $deleteBtn = "<a href='" . route('admin.orders.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                $showBtn = "<a href='" . route('admin.orders.show', $query->id) . "' class='btn btn-primary'><i class='far fa-eye'></i></a>";

                return $showBtn . $deleteBtn;
            })
            ->addColumn('client', function ($query) {
                if ($query->user_id == null) {
                    return 'Guest User';
                } else {
                    $user = $query->user->first_name . ' ' . $query->user->last_name;
                    return $user;
                }
            })
            ->addColumn('product', function ($query) {
                $htmlOutput = '';
                foreach ($query->orderItems as $items) {
                    $htmlContent = $items->item->name;
                    $br = '<br>';
                    $htmlOutput .= '<li>' . $htmlContent . $br . '</li>';
                }
                return '<ol>' . $htmlOutput . '</ol>';
            })
            ->addColumn('item', function ($query) {
                $htmlOutput = '';
                foreach ($query->orderItems as $items) {
                    $htmlContent = $items->variant->unit;
                    $br = '<br>';
                    $htmlOutput .= '<li>' . $htmlContent . $br . '</li>';
                }
                return '<ol>' . $htmlOutput . '</ol>';
            })
            ->addColumn('date', function ($query) {
                return date('d-M-y', strtotime($query->created_at));
            })
            ->addColumn('paid_from', function ($query) {
                if ($query->transaction->payment_method == 'bkash') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1656234745bkash-app-logo-png.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>" . $query->transaction->payment_id . "</span>";
                } elseif ($query->transaction->payment_method == 'Nagad') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>" . $query->transaction->payment_id . "</span>";
                } elseif ($query->transaction->payment_method == 'Rocket') {
                    return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>" . $query->transaction->payment_id . "</span>";;
                } elseif ($query->transaction->payment_method == 'nagad') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>" . $query->transaction->payment_id . "</span>";
                } elseif ($query->transaction->payment_method == 'rocket') {
                    return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>" . $query->transaction->payment_id . "</span>";;
                } else {
                    return $query->transaction->payment_id;
                }
            })
            ->addColumn('paid_to', function ($query) {
                if ($query->transaction->paid_to) {
                    if ($query->transaction->payment_method == 'bkash') {
                        return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1656234745bkash-app-logo-png.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>" . $query->transaction->paid_to . "</span>";
                    } elseif ($query->transaction->payment_method == 'Nagad') {
                        return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>" . $query->transaction->paid_to . "</span>";
                    } elseif ($query->transaction->payment_method == 'Rocket') {
                        return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>" . $query->transaction->paid_to . "</span>";;
                    } elseif ($query->transaction->payment_method == 'nagad') {
                        return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>" . $query->transaction->paid_to . "</span>";
                    } elseif ($query->transaction->payment_method == 'rocket') {
                        return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>" . $query->transaction->paid_to . "</span>";;
                    } else {
                        return $query->transaction->paid_to;
                    }
                } elseif ($query->transaction->payment_method == 'bkash') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1656234745bkash-app-logo-png.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>01886599351</span>";
                } elseif ($query->transaction->payment_method == 'Nagad') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>01886599351</span>";
                } elseif ($query->transaction->payment_method == 'Rocket') {
                    return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>019608002209</span>";;
                } elseif ($query->transaction->payment_method == 'nagad') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>01886599351</span>";
                } elseif ($query->transaction->payment_method == 'rocket') {
                    return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>019608002209</span>";;
                }
            })
            ->addColumn('transaction_id', function ($query) {
                return $query->transaction->transaction_id;
            })
            ->addColumn('final_bill', function ($query) {
                if ($query->region == 'Global')
                    return $query->total . ' BDT';
                elseif ($query->region == 'Malaysia') {
                    return $query->total . ' RM';
                }
            })
            ->addColumn('invoice_no', function ($query) {
                return $query->invoice_id;
            })
            ->addColumn('payment_status', function ($query) {
                if ($query->payment_status == 'pending') {
                    return "<span class= 'badge bg-warning' style='width:80px; color: black;'>$query->payment_status</span>";
                } elseif ($query->payment_status == 'partial') {
                    return "<span class= 'badge bg-info' style='width:80px; color: black;'>$query->payment_status</span>";
                } elseif ($query->payment_status == 'approved') {
                    return "<span class= 'badge bg-success' style='width:80px; color: black;'>$query->payment_status</span>";
                } else {
                    return "<span class= 'badge bg-danger' style='width:80px; color: black;'>$query->payment_status</span>";
                }
            })
            ->addColumn('order_status', function ($query) {
                if ($query->order_status == 'pending') {
                    return "<span class= 'badge bg-warning' style='width:90px; color: black;'>$query->order_status</span>";
                } elseif ($query->order_status == 'processing') {
                    return "<span class= 'badge bg-primary' style='width:90px; color: black;'>$query->order_status</span>";
                } elseif ($query->order_status == 'on hold') {
                    return "<span class= 'badge bg-secondary' style='width:90px; color: black;'>$query->order_status</span>";
                } elseif ($query->order_status == 'delivered') {
                    return "<span class= 'badge' style='width:90px; color: #fff; background: #008080'>$query->order_status</span>";
                } elseif ($query->order_status == 'completed') {
                    return "<span class= 'badge bg-success' style='width:90px; color: black;'>$query->order_status</span>";
                } elseif ($query->order_status == 'cancelled') {
                    return "<span class= 'badge bg-danger' style='width:90px; color: black;'>$query->order_status</span>";
                } elseif ($query->order_status == 'refunded') {
                    return "<span class= 'badge' style='width:90px; color: #fff; background: #990099'>$query->order_status</span>";
                } elseif ($query->order_status == 'failed') {
                    return "<span class= 'badge' style='width:90px; color: #fff; background: #8B4513'>$query->order_status</span>";
                } elseif ($query->order_status == 'returned') {
                    return "<span class= 'badge' style='width:90px; color: #fff; background: #800000'>$query->order_status</span>";
                } else {
                    return "<span class= 'badge bg-danger' style='width:90px; color: black;'>$query->order_status</span>";
                }
            })
            ->filterColumn('invoice_no', function ($query, $keyword) {
                $query->where('invoice_id', 'like', "%$keyword%");
            })
            ->rawColumns(['paid_to', 'action', 'product', 'item', 'final_bill', 'invoice_no', 'client', 'date', 'paid_from', 'payment_status', 'order_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        if ($this->region) {
            $model = $model->where('region', $this->region);
        }
        if ($this->order_status) {
            $model = $model->where('order_status', $this->order_status);
        }

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('order-table')
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
            Column::make('id')->addClass('text-center')->addClass('align-middle'),
            Column::make('invoice_no')->addClass('text-center')->addClass('align-middle'),
            Column::make('client')->addClass('text-center')->addClass('align-middle')->width(100),
            Column::make('product')->addClass('text-center')->addClass('align-middle')->width(200),
            Column::make('item')->addClass('text-center')->width(200),
            Column::make('paid_to')->width(150)->addClass('align-middle'),
            Column::make('paid_from')->width(150)->addClass('align-middle'),
            Column::make('transaction_id')->addClass('text-center')->addClass('align-middle'),
            Column::make('final_bill')->addClass('text-center')->addClass('align-middle'),
            Column::make('payment_status')->addClass('text-center')->addClass('align-middle'),
            Column::make('order_status')->addClass('text-center')->addClass('align-middle'),
            Column::make('date')->addClass('text-center')->addClass('align-middle'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}
