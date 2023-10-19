<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\ResponObject;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\test;
use App\Models\TypeAccount;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
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
        $store = Store::orderBy('created_at', 'DESC')->paginate(2);
        $sort = "created_at";
        if ($sortBy) {
            $sort = $sortBy;
        }
        if (isset($keyword)) {
            $store = Store::where('nameStore', 'like', '%' . $keyword . '%')->orderBy($sort, 'DESC')
                ->paginate(2);
            $store->appends(request()->all())->links();
        }
        $result = response()->json([
            'status' => true,
            'message' => 'get all store',
            'data' => $store
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
        $data = $request->all();
        $this->validate($request, [
            'nameStore' => 'required',
            'username' =>  'required',
            'password' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:10|min:10',
            'address' => 'required'
        ]);
        //
        $exist = Store::where('username', $data['username'])->first();
        $existEmail = Store::where('email', $data['email'])->first();
        $existPhone = Store::where('phone', $data['phone'])->first();

        if ($exist) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'username đã tồn tại',
                    'data' => ''
                ]
            );
        }
        if ($existEmail) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'email đã tồn tại',
                    'data' => ''
                ]
            );
        }
        if ($existPhone) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'phone đã tồn tại',
                    'data' => ''
                ]
            );
        }
        $store = Store::create($data);
        $store->addressStore()->create([
            'latitude' => $request->input('address.latitude'),
            'longitude' => $request->input('address.longitude')
        ]);
        $result = response()->json(
            [
                'status' => true,
                'message' => 'Thêm thành công',
                'data' => $store
            ]
        );
        return $store;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $store = Store::find($id);
        
        if ($store == null) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Không tìm thấy store cần thay đổi',
                    'data' => ''
                ]
            );
        }
        $store->products;
        return response()->json(
            [
                'status' => true,
                'message' => 'Tìm thành công',
                'data' => $store
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
        //
        $data = $request->all();
        //
        
        $store = Store::find($id);
        if ($store == null) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Không tìm thấy store cần thay đổi',
                    'data' => ''
                ]
            );
        }
        $store->update($data);
        $result = response()->json(
            [
                'status' => true,
                'message' => 'Thay đổi thành công cửa hàng id =' . $id,
                'data' => $store
            ]
        );
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::find($id);
        if ($store == null) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Không tìm thấy store cần xoá',
                    'data' => ''
                ]
            );
        }
        $store->delete();
        $result = response()->json(
            [
                'status' => true,
                'message' => 'Xoá thành công',
                'data' => $store
            ]
        );
        return $result;
        //
    }
}
