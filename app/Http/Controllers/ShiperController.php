<?php

namespace App\Http\Controllers;

use App\Models\AddressShiper;
use App\Models\Customer;
use App\Models\Shiper;
use App\Models\TypeAccount;
use Illuminate\Http\Request;
use Mockery\Undefined;

class ShiperController extends Controller
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
        $shipers = Shiper::orderBy('created_at', 'DESC')->paginate(2);

        $sort = "created_at";
        if ($sortBy) {
            $sort = $sortBy;
        }

        if (isset($keyword) || isset($sort)) {
            $shipers = Shiper::where('fullname', 'like', '%' . $keyword . '%')->orderBy($sort)
                ->paginate(2);
            $shipers->appends(request()->all())->links();
        }
        $result = response()->json([
            'status' => true,
            'message' => 'get all shipers',
            'data' => $shipers
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
            'nameStore' => 'required',
            'username' =>  'required',
            'password' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:10|min:10',
            'address' => 'required'
        ]);
        $data = $request->all();
        $exist = Shiper::where('username', $data['username'])->first();
        $existEmail = Shiper::where('email', $data['email'])->first();
        $existPhone = Shiper::where('phone', $data['phone'])->first();
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
        $shiper = Shiper::create($data);
        $result = response()->json(
            [
                'status' => true,
                'message' => 'Thêm thành công',
                'data' => $shiper
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
        $shiper = Shiper::find($id);
        if ($shiper == null) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Không tìm thấy shiper có id = ' . $id,
                    'data' => ''
                ]
            );
        }

        $result = response()->json(
            [
                'status' => true,
                'message' => 'thông tin shiper',
                'data' => $shiper
            ]
        );
        return $result;
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
        $shiper = Shiper::find($id);
        if ($shiper == null) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Không tìm thấy Shiper có id = ' . $id,
                    'data' => ''
                ]
            );
        }
        $data = $request->all();
        $shiper->update($data);
        // //
        $result = response()->json(
            [
                'status' => true,
                'message' => 'cập nhật thành công',
                'data' => $shiper
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
        $shiper = Shiper::find($id);
        if ($shiper == null) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Không tìm thấy shiper có id = ' . $id,
                    'data' => ''
                ]
            );
        }
        $shiper->delete();
        $result = response()->json(
            [
                'status' => true,
                'message' => 'Xoá thành công',
                'data' => $shiper
            ]
        );
        return $result;
        //
    }
}
