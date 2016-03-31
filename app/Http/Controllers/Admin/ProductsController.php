<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = new Products;
        return view('admin.products.index')->withProducts($products->paginate(env('PERPAGE')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:products|max:255',
            'price' => 'required|digits_between:1,9999',
            'amount' => 'required|digits_between:1,999999',
            'describe' => 'required|max:500',
        ]);
        // dd($request->all());
        $products = new Products;
        $products->name = $request->name;
        $products->price = $request->price;
        $products->type = $request->type;
        $products->amount = $request->amount;
        $products->describe = $request->describe;

        if ($products->save()) {
            return redirect()->route('admin/products')->withMsg("Create product 《{$request->name}》 success.");
        } else {
            return redirect()->back()->withInput()->withMsg("Create product 《{$request->name}》 failed.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        return view('admin.products.edit')->withProduct($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Products::find($id);

        if ($product->name != $request->name) {
            $this->validate($request, ['name' => 'required|unique:products|max:255']);
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|digits_between:1,9999',
            'amount' => 'required|digits_between:1,999999',
            'describe' => 'required|max:500',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->amount = $request->amount;
        $product->describe = $request->describe;
        if ($product->save()) {
            return redirect()->route('admin/products')->withMsg("Edit product 《{$request->name}》 success.");
        } else {
            return redirect()->back()->withInput()->withMsg("Edit product 《{$request->name}》 failed.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $product = Products::find($id);
        if ($product->destroy($id)) {
            return redirect()->route('admin/products')->withMsg("Destroy product 《{$id}.{$product->name}》 success.");
        } else {
            return redirect()->route('admin/products')->withMsg("Destroy product 《{$id}.{$product->name}》 failed.");
        }
    }
}
