<?php

namespace App\Http\Controllers;

use App\Models\Address;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\TypeAccount;
use Illuminate\Support\Facades\App;

class CustomerController extends Controller
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
        $sort = "created_at";
        if ($sortBy) {
            $sort = $sortBy;
        }
        $customers = Customer::orderBy('created_at', 'DESC')->paginate(2);

        if (isset($keyword) || isset($sortBy)) {
            $customers = Customer::where('fullname', 'like', '%' . $keyword . '%')->orderBy($sort, 'DESC')
                ->paginate(2);
            $customers->appends(request()->all())->links();
        }
        $result = response()->json([
            'status' => true,
            'data' => $customers
        ]);
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //
        $this->validate($request, [
            'fullname' => 'required',
            'username' =>  'required',
            'password' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:10|min:10',
            'address' => 'required'
        ]);

        $exist = Customer::where('username', $data['username'])->first();
        $existEmail = Customer::where('email', $data['email'])->first();
        $existPhone = Customer::where('phone', $data['phone'])->first();
        $customer = Customer::create($data);
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
        $result = response()->json(
            [
                'status' => true,
                'message' => 'Thêm thành công',
                'data' => $customer
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
        $customer = Customer::find($id);
        if ($customer == null) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy khách hàng có id' . $id,
                'data' => ''
            ]);
        }

        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
        $customer = Customer::find($id);
        $data = $request->all();
        if ($customer == null) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Không tìm thấy customer cần thay đổi',
                    'data' => ''
                ]
            );
        }
        $customer->update($data);
        $result = response()->json(
            [
                'status' => true,
                'message' => 'cập nhật thành công',
                'data' => $customer
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
        $customer = Customer::find($id);
        if ($customer == null) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Không tìm thấy khách hàng có id: ' . $id,
                    'data' => ''
                ]
            );
        }
        $customer->delete();
        $result = response()->json(
            [
                'status' => true,
                'message' => 'Xoá thành công',
                'data' => $customer
            ]
        );
        return $result;
        //
    }
}
