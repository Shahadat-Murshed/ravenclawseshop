<?php

namespace App\DataTables;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PaymentMethodDataTable extends DataTable
{
    protected $name;

    public function setName($name)
    {
        $this->name = $name;
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
                if($query->is_default == 1){
                    $editBtn = "<a href='" . route('admin.paymentmethods.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                    $deleteBtn = "<button disabled class='btn btn-outline-secondary ml-2'><i class='far fa-trash-alt'></i></button>";
                    return $editBtn. $deleteBtn;
                }else{
                    $editBtn = "<a href='" . route('admin.paymentmethods.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                    $deleteBtn = "<a href='" . route('admin.paymentmethods.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
    
                    return $editBtn . $deleteBtn;
                }
            })
            ->addColumn('method', function ($query) {
                if ($query->name == 'bkash') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1656234745bkash-app-logo-png.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>Bkash</span>";
                }
                if ($query->name == 'nagad') {
                    return "<img class= 'logo' src='https://freelogopng.com/images/all_img/1679248787Nagad-Logo.png' alt='logo' style='height:20px;width:20px;object-fit:cover' ><span class='ml-2'>Nagad</span>";
                }
                if ($query->name == 'rocket') {
                    return "<img class= 'logo' src='https://seeklogo.com/images/D/dutch-bangla-rocket-logo-B4D1CC458D-seeklogo.com.png' alt='logo' style='height:20px;width:20px;' ><span class='ml-2'>Rocket</span>";
                } else {
                    $name = ucfirst($query->name);
                    return $name;
                }
            })
            ->addColumn('region', function ($query) {
                if ($query->region == 'global') {
                    return "Bangladesh";
                } elseif ($query->region == 'malay') {
                    return "Malaysia";
                } else {
                    return "Global";
                }
            })
            ->addColumn('default', function ($query) {
                if ($query->name == 'bkash') {
                    if ($query->is_default == 1) {
                        $button = '<label class="custom-switch mt-2">
                            <i style="font-size: 20px; color: green" class="fa-regular fa-circle-check"></i>
                        </label>';
                    } else {
                        $button = '<label class="custom-switch mt-2">
                            <input type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-default">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                    }
                    return $button;
                } elseif ($query->name == 'nagad') {
                    if ($query->is_default == 1) {
                        $button = '<label class="custom-switch mt-2">
                            <i style="font-size: 20px; color: green" class="fa-regular fa-circle-check"></i>
                        </label>';
                    } else {
                        $button = '<label class="custom-switch mt-2">
                            <input type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-default">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                    }
                    return $button;
                } elseif ($query->name == 'rocket') {
                    if ($query->is_default == 1) {
                        $button = '<label class="custom-switch mt-2">
                            <i style="font-size: 20px; color: green" class="fa-regular fa-circle-check"></i>
                        </label>';
                    } else {
                        $button = '<label class="custom-switch mt-2">
                            <input type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-default">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                    }
                    return $button;
                } elseif ($query->name == 'crypto') {
                    if ($query->is_default == 1) {
                        $button = '<label class="custom-switch mt-2">
                            <i style="font-size: 20px; color: green" class="fa-regular fa-circle-check"></i>
                        </label>';
                    } else {
                        $button = '<label class="custom-switch mt-2">
                            <input type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-default">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                    }
                    return $button;
                } elseif ($query->name == 'cryptox') {
                    if ($query->is_default == 1) {
                        $button = '<label class="custom-switch mt-2">
                            <i style="font-size: 20px; color: green" class="fa-regular fa-circle-check"></i>
                        </label>';
                    } else {
                        $button = '<label class="custom-switch mt-2">
                            <input type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-default">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                    }
                    return $button;
                } elseif ($query->name == 'cryptoy') {
                    if ($query->is_default == 1) {
                        $button = '<label class="custom-switch mt-2">
                            <i style="font-size: 20px; color: green" class="fa-regular fa-circle-check"></i>
                        </label>';
                    } else {
                        $button = '<label class="custom-switch mt-2">
                            <input type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-default">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                    }
                    return $button;
                } else {
                    if ($query->is_default == 1) {
                        $button = '<label class="custom-switch mt-2">
                            <i style="font-size: 20px; color: green" class="fa-regular fa-circle-check"></i>
                        </label>';
                    } else {
                        $button = '<label class="custom-switch mt-2">
                            <input type="checkbox" name="custom-switch-checkbox" data-id="' . $query->id . '" class="custom-switch-input change-default">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                    }
                    return $button;
                }
            })
            ->rawColumns(['action', 'default', 'method'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PaymentMethod $model): QueryBuilder
    {
        if ($this->name) {
            $model = $model->where('name', $this->name)->orderBy('is_default', 'desc');
        }
        return $model->newQuery()->orderBy('is_default', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('paymentmethod-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
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
            Column::make('id'),
            Column::make('region'),
            Column::make('method'),
            Column::make('number'),
            Column::make('default')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center')->addClass('align-middle'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PaymentMethod_' . date('YmdHis');
    }
}
