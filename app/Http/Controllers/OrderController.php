<?php


namespace App\Http\Controllers;

// require_once('App\Services\CaculateService.php');
use App\Models\Order;
use App\Models\Status;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')->paginate(6);
        foreach ($orders as $key => $value) {
            $value->orderDetail;
            foreach ($value->status as $k => $v) {
                $v->status;
            }
        }
        // $sort = "created_at";
        $result = response()->json([
            'status' => true,
            'data' => $orders
        ]);
        return $result;

        // // Lấy thông tin về 2 vị trí địa lý
        // $location1 = $geocoder->geocode('Thảo cầm viên Sài Gòn');
        // $location2 = $geocoder->geocode('Nhà thờ Đức Bà');

        // // Tính khoảng cách giữa 2 vị trí
        // $distance = $location1->distanceTo($location2);

        // Trả về kết quả
        // return response()->json(['distance' => $distance]);
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
        
        $store = Store::find($request['idStore']);
        if($store == null) {
            return response() -> json([
                'status' => false,
                'message' => 'Store không tồn tại'
            ]);
        }
        $data = $request->all();
        $orderDetails = $request->input('orderDetails');
        $order = Order::create([
            'idCustomer' => $data['idCustomer'],
            'idShiper' => $data['idShiper'],
            'idStore' => $data['idStore'],
            'address' => $data['address']
        ]);

        foreach ($orderDetails as $key => $value) {
            $order->orderDetail()->create([
                'idProduct' => $value['idProduct'],
                'quantity' => 1,
                'size' => $value['size']
            ]);
        }
        $order->status()->create(
            [
                'idStatus' => 1
            ]
        );
        // Log::channel('customer')->info("id customer order " . $data['idCustomer']);
        // Lấy thông tin thiết bị
        // $clientInfo = $_SERVER;
        // $deviceId = $_SERVER['HTTP_X_APP_DEVICE_ID'];
        // Lấy ID thiết bị
        // $deviceId = $clientInfo->getDeviceId();

        // $result = sendCloudMessase($token,"Thông báo ",[
        // Tạo một kết nối HTTP với API FCM
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/deliveryfood-401305/registrations/DEVICE_ID/token');
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Lấy ID thiết bị từ request
        // $deviceId = $_POST['deviceId'];

        // Thực hiện yêu cầu HTTP
        // $response = curl_exec($ch);

        // Giải mã phản hồi JSON
        // $data = json_decode($response, true);

        // Lấy token device
        // $token = $data['token'];

        // Đóng kết nối HTTP
        // curl_close($ch);
        // Create a FirebaseMessaging object
        // $firebaseMessaging = new FirebaseMessaging();

        // Request permission to send notifications
        // $firebaseMessaging->requestPermission();

        // Get the device token
        // $deviceToken = $firebaseMessaging->getToken();
        // Get the device token from the FCM server

        // $url = 'https://fcm.googleapis.com/v1/projects/deliveryfood-401305/devices/tokens';
        // $headers = [
        //   'Authorization' => 'Bearer AAAAWWwUUOc:APA91bERejUeAWrpNXBQe6oQhb-uBvD9qUTQcKs-RxlaGEla1Rv4aLvAjiGWKND2NVdfCKaiV95zIFxbGNpdoOyfIOlLlZto79WqXTIPRJGpFGKxGy8PkBbDs4frvQK3oDoD7uV2qf-7',
        //   'Content-Type' => 'application/json',
        // ];
        // $payload = json_encode([

        // ]);

        // $ch = curl_init($url);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $response = curl_exec($ch);
        // curl_close($ch);

        // if ($response === false) {
        //   throw new Exception('Curl error: ' . curl_error($ch));
        // }

        // $json = json_decode($response);

        // $registration_id = $json->token;
        // $message = new MessageService();
        // $result = $message -> sendCloudMessase('7473d3fe51ea2fae3a0fe13757ae4440f2d3c038','Thông báo', [
        //     'title' => 'thông báo',
        //     'content' => 'thông báo 123'
        // ]);

        // 



        return response()->json($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        foreach ($order->status as $key => $value) {
            $value->status;
        }
        if ($order == null) {
            return response()->json([
                'status' => false,
                'message' => 'not found order',
                'data' => '',
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'not found order',
            'data' => $order
        ]);
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
        $order = Order::find($id);
        if ($order == null) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy order cần cập nhật',
                'data' => ''
            ]);
        }
        $status = Status::find($request['status']);
        if ($status == null) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy status cần cập nhật',
                'data' => ''
            ]);
        }
        $order->status()->create([
            'idOrder' => $order->id,
            'idStatus' => $status->id
        ]);



        return response()->json([
            'status' => true,
            'message' => 'cập nhật thành công',
            'data' => $order
        ]);
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

    public function caculate(Request $request)
    {
        $data = $request->all();
        $store = Store::find($data['idStore']);
        $earthRadius = 6371.01;

        $store->addressStore;
        $latitudeStore = $store->addressStore->latitude; // vĩ độ
        $longitudeStore = $store->addressStore->longitude; // kinh độ

        $latitudeShiper = $data['latitudeShiper']; //10.853868278029905;  // vĩ độ
        $longitudeShiper = $data['longitudeShiper']; //106.626213725545; // kinh độ


        $latitude1InRadians = deg2rad($latitudeStore);
        $longitude1InRadians = deg2rad($longitudeStore);

        $latitude2InRadians = deg2rad($latitudeShiper);
        $longitude2InRadians = deg2rad($longitudeShiper);


        // Calculate the distance
        $distance = 2 * $earthRadius * asin(sqrt(pow(sin($latitude1InRadians - $latitude2InRadians) / 2, 2) +
            cos($latitude1InRadians) * cos($latitude2InRadians) *
            pow(sin($longitude1InRadians - $longitude2InRadians) / 2, 2)));

        $distanceInKm = round($distance, 2);
        // Trả về khoảng cách
        // Ví dụ
        return response()->json($distanceInKm);
    }
}
