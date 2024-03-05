<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PaymentMethodDataTable;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class ManagePaymentMethodController extends Controller
{
    public function index(PaymentMethodDataTable $dataTable)
    {
        $user = "Payment";
        $route = 0;
        return $dataTable->render('admin.managePaymentMethods.index', compact('user', 'route'));
    }

    public function bkash(PaymentMethodDataTable $dataTable)
    {
        $name = "bkash";
        $user = "bKash";
        $route = 'admin.payments.bkash.create';
        $dataTable->setName($name);
        return $dataTable->render('admin.managePaymentMethods.index', compact('user', 'route'));
    }

    public function createBkash()
    {
        $name = "bkash";
        $region = "Bangladesh";
        $user = "bKash";
        $route = 'admin.payments.bkash.store';
        return view('admin.managePaymentMethods.create', compact('name', 'user', 'route', 'region'));
    }

    public function storebkash(Request $request)
    {
        $request->validate(
            [
                'number' => ['required', 'regex:/^\d{11}$|^\+8801[0-9]{9}$/'],
            ],
            [
                'number.required' => 'Please enter a valid Phone Number',
            ]
        );

        if (PaymentMethod::where('number', $request->number)->where('name', 'bkash')->exists()) {
            toastr('Bkash Number Already Exists', 'error', 'error');
            return redirect()->back();
        };
        $bkash = new PaymentMethod();
        $bkash->region = 'global';
        $bkash->name = 'bkash';
        $bkash->number = $request->number;
        $bkash->save();

        toastr('Bkash Number Created Successfully', 'success', 'Success');

        return redirect()->route('admin.payments.bkash.list');
    }


    public function nagad(PaymentMethodDataTable $dataTable)
    {
        $name = "nagad";
        $user = "Nagad";
        $route = 'admin.payments.nagad.create';
        $dataTable->setName($name);
        return $dataTable->render('admin.managePaymentMethods.index', compact('user', 'route'));
    }

    public function createNagad()
    {
        $name = "nagad";
        $region = "Bangladesh";
        $user = "Nagad";
        $route = 'admin.payments.nagad.store';
        return view('admin.managePaymentMethods.create', compact('name', 'user', 'route', 'region'));
    }

    public function storeNagad(Request $request)
    {
        $request->validate(
            [
                'number' => ['required', 'regex:/^\d{11}$|^\+8801[0-9]{9}$/'],
            ],
            [
                'number.required' => 'Please enter a valid Phone Number',
            ]
        );
        if (PaymentMethod::where('number', $request->number)->where('name', 'nagad')->exists()) {
            toastr('Nagad Number Already Exists', 'error', 'error');
            return redirect()->back();
        };
        $nagad = new PaymentMethod();
        $nagad->region = 'global';
        $nagad->name = 'nagad';
        $nagad->number = $request->number;
        $nagad->save();

        toastr('Nagad Number Created Successfully', 'success', 'Success');

        return redirect()->route('admin.payments.nagad.list');
    }

    public function rocket(PaymentMethodDataTable $dataTable)
    {
        $name = "rocket";
        $user = "Rocket";
        $route = 'admin.payments.rocket.create';
        $dataTable->setName($name);
        return $dataTable->render('admin.managePaymentMethods.index', compact('user', 'route'));
    }

    public function createRocket()
    {
        $name = "rocket";
        $region = "Bangladesh";
        $user = "Rocket";
        $route = 'admin.payments.rocket.store';
        return view('admin.managePaymentMethods.create', compact('name', 'user', 'route', 'region'));
    }

    public function storeRocket(Request $request)
    {
        $request->validate(
            [
                'number' => ['required', 'regex:/^\d{12}$|^\+8801[0-9]{10}$/'],
            ],
            [
                'number.required' => 'Please enter a valid Phone Number',
                'number.regex' => 'The Number should be of 12 digits',
            ]
        );

        if (PaymentMethod::where('number', $request->number)->where('name', 'rocket')->exists()) {
            toastr('Rocket Number Already Exists', 'error', 'error');
            return redirect()->back();
        };
        $rocket = new PaymentMethod();
        $rocket->region = 'global';
        $rocket->name = 'rocket';
        $rocket->number = $request->number;
        $rocket->save();

        toastr('Rocket Number Created Successfully', 'success', 'Success');

        return redirect()->route('admin.payments.rocket.list');
    }

    public function crypto(PaymentMethodDataTable $dataTable)
    {
        $name = "crypto";
        $user = "Crypto";
        $route = 'admin.users.list';
        $dataTable->setName($name);
        return $dataTable->render('admin.managePaymentMethods.index', compact('user', 'route'));
    }
    public function cryptox(PaymentMethodDataTable $dataTable)
    {
        $name = "cryptox";
        $user = "CryptoX";
        $route = 'admin.users.list';
        $dataTable->setName($name);
        return $dataTable->render('admin.managePaymentMethods.index', compact('user', 'route'));
    }
    public function cryptoy(PaymentMethodDataTable $dataTable)
    {
        $name = "cryptoy";
        $user = "CryptoY";
        $route = 'admin.users.list';
        $dataTable->setName($name);
        return $dataTable->render('admin.managePaymentMethods.index', compact('user', 'route'));
    }

    public function edit(string $id)
    {
        $method = PaymentMethod::findOrFail($id);
        $name = $method->name;
        if ($method->region == 'global') {
            $region = "Bangladesh";
        } elseif ($method->region == 'malay') {
            $region = 'Malaysia';
        }
        $user = ucfirst($method->name);
        return view('admin.managePaymentMethods.edit', compact('method', 'name', 'region', 'user'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'number' => ['required', 'max:200'],
            ],
            [
                'number.required' => 'Please enter a valid Phone Number',
            ]
        );

        $method = PaymentMethod::findOrFail($id);
        if (PaymentMethod::where('number', $request->number)->where('name', $method->name)->exists()) {
            toastr('This ' . ucfirst($method->name) . ' Number Already Exists', 'warning', 'warning');
            return redirect()->back();
        };
        $method->number = $request->number;
        $method->save();

        toastr('Updated Successfully', 'success', 'Success');

        return redirect()->route('admin.payments.all.list');
    }

    public function makeDefault(Request $request)
    {
        $targetmethod = PaymentMethod::findOrFail($request->id);
        $methods = PaymentMethod::where('name', $targetmethod->name)->get();
        foreach ($methods as $method) {
            $method->is_default = 0;
            $method->save();
        }

        $targetmethod->is_default = 1;
        $targetmethod->save();
        return response(['message' => 'Status has been updated!']);
    }

    public function destroy(string $id)
    {
        $method = PaymentMethod::findOrFail($id);
        if(!$method->is_default){
            $method->delete();
        }else{
            return response(['status' => 'error', 'message' => 'Default Number can not be deleted']);
        }

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
