<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $keyword = request()->get('keyword');
        $sortBy = request()->get('sort');
        $product = Product::orderBy('created_at', 'DESC')->paginate(6);
        
        $sort = "created_at";
        if($sortBy){
            $sort = $sortBy;
        }

        if (isset($keyword) || isset($sort)) {
            $product = Product::where('name', 'like', '%' . $keyword . '%')->orderBy($sort)
                ->paginate(6);
            $product -> appends(request() -> all())->links();
        }
        
        $result = response()->json([
            'status' => true,
            'data' => $product
        ]);
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'idStore' => 'required',
            'name' =>  'required',
            'productDetail' => 'required'
        ]);
        $store = Store::find($request['idStore']);
        if($store == null){
            return  response() -> json(
                [
                    'status' => false,
                    'message' => 'Cửa hàng bạn muốn thế sản phẩm không tồn tại',
                    'data' => ''
                ]
            );
        }
        $product =  $store->products()->create([
            'name' => $request->name
        ]);
        //
        $detailProduct = $request->input('productDetail');
        foreach ($detailProduct as $key => $value) {
            $product-> productDetails() -> create([
                'price' => $value['price'],
                'size' => $value['size']
            ]);
        }
        $product -> productDetails;
        $product -> store;

        $result = response() -> json(
            [
                'status' => true,
                'message' => 'Thêm sản phẩm thành công',
                'data' => $product
            ]
        );
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::find($id);
        if($product == null) {
            return  response() -> json(
                [
                    'status' => false,
                    'message' => 'Không tìm thấy sản phẩm có id : '.$id,
                    'data' => ''
                ]
            );
        }
        $product -> productDetails;
        $product -> store;
        return response() -> json(
            [
                'status' => true,
                'message' => 'Tìm thấy sản phẩm có id : '.$id,
                'data' => $product
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $product =  Product::find($id);
        if($product == null){
            return response() -> json(
                [
                    'status' => false,
                    'message' => 'Không tìm thấy sản phẩm cần thay đổi',
                    'data' => ''
                ]
            );
        }
        $product -> update([
            'name' => $request->name
        ]);
        //
        $detailProduct = $request->input('productDetail');
        foreach ($detailProduct as $key => $value) {
            $product-> productDetails() -> update([
                'price' => $value['price'],
                'size' => $value['size']
            ]);
        }
        $product -> productDetails;
        $product -> store;

        $result = response() -> json(
            [
                'status' => true,
                'message' => 'Thêm sản phẩm thành công ',
                'data' => $product
            ]
        );
        return $result;
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
