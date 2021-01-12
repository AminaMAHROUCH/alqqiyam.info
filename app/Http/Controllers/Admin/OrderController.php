<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Member;
use App\Models\Order;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::all();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        abort_if(Gate::denies('order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = Product::all()->pluck('name', 'id');

        $members = Member::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.orders.create', compact('names', 'members'));
    }

    public function store(StoreOrderRequest $request)
    {
         $order = Order::create($request->all());

        $products = $request->input('names', []);
        $quantities = $request->input('quantity', []);
        for ($product=0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $order->names()->attach($products[$product], ['quantity' => $quantities[$product]]);
            }
        }
        //dd($request->status);

        return redirect()->route('admin.orders.index');
    }

    public function edit(Order $order)
    {
        abort_if(Gate::denies('order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $names = Product::all()->pluck('name', 'id');

        $members = Member::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $order->load('names', 'member');

        return view('admin.orders.edit', compact('names', 'members', 'order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update($request->all());

        $order->names()->detach();
        $products = $request->input('names', []);
        $quantities = $request->input('quantity', []);
        for ($product=0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $order->names()->attach($products[$product], ['quantity' => $quantities[$product]]);
        }

        return redirect()->route('admin.orders.index');
    }
}

    public function show(Order $order)
    {
        abort_if(Gate::denies('order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->load('names', 'member');

        return view('admin.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        abort_if(Gate::denies('order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrderRequest $request)
    {
        Order::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}