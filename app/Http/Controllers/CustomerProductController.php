<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\CustomerProduct ;                                           //as用法:將左邊所引用的類別命名誠新類別名稱

class CustomerProductController extends Controller
{
    private $customerProduct;

    public function __construct()
    {
        parent::__construct();
        $this->customerProduct = new CustomerProduct();
    }


    /**
     * 查看customer_produces整個資料表
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $result = $this->customerProduct->getInfo();

        if ($result->isEmpty()) {
            $response = [
                'result'  => 'OK',
                'message' => '經查詢後並無此資料',
                'data'    => [],
            ];
            return $response;
        }
        $response = [
            'result'  => 'OK',
            'message' => '資料撈取成功',
            'data'    => $result,
        ];
        return $response;
    }

    /**
     * 新增單筆客戶訂購資料
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        #確認所有欄位都有正確填入
        $check_result = $this->checkIfExistData($request);

        if ($check_result['result'] === 'Error') {
            return $check_result;
        }
        #開始新增客戶訂購資料
        $create_information = [
            'customer'      => $request->customer,
            'material'      => $request->material,
            'telephone'     => $request->telephone,
            'thickness'     => $request->thickness,
            'width'         => $request->width,
            'length'        => $request->length,
            'quantity'      => $request->quantity,
            'shipment_date' => $request->shipment_date
        ];
        $result = $this->customerProduct->createInfo($create_information)->toArray();
        if (!$result) {
            $response = [
                'result'  => 'Error',
                'message' => 'Please try again!',
                'data'    =>  null,
            ];
            return $response;
        }
        $response = [
            'result'  => 'OK',
            'message' => 'Create the information successfully!',
            'data'    =>  null
        ];
        return $response;
    }

    /**
     * 搜尋指定客戶過去訂購材料資訊
     * @param Request $request
     * @param $id
     * @return array
     */
    public function show(Request $request, $id)
    {
        #客戶名稱為必填欄位
        if (!isset($request->customer)) {
           $response = [
            'result'  => 'Error',
            'message' => 'Customer name must be filled!',
            'data'    =>  null
               ];
           return $response;
        }
        #開始依客戶名稱搜尋資料
        $search_condition = [
            'id' => $id,
            'customer' => $request->customer,
        ];
        $result = $this->customerProduct->firstInfo($search_condition);

        if ($result !== 0) {
            $response = [
                'result'  => 'OK',
                'message' => 'Check ok!',
                'data'    => $result
            ];
            return $response;
        }
        $response = [
            'result'  => 'Error',
            'message' => 'Please check your information.',
            'data'    => null
        ];
        return $response;

    }

    /**
     * 更改指定客戶過去訂購材料資訊
     * @param Request $request
     * @param $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        #確認所有欲更改的資料都有填妥!
        $check_result = $this->checkIfExistData($request);

        if ($check_result['result'] === 'Error') {
            return $check_result;
        }
        #開始執行更改
        $search_condition = [
            'id' => $id,
        ];
        $change_Information = [
            'customer'      => $request->customer,
            'material'      => $request->material,
            'telephone'     => $request->telephone,
            'thickness'     => $request->thickness,
            'width'         => $request->width,
            'length'        => $request->length,
            'quantity'      => $request->quantity,
            'shipment_date' => $request->shipment_date,
        ];
        $result = $this->customerProduct->updateInfo($search_condition, $change_Information);
        if ($result !== 0) {
            $response = [
                'result'  => 'OK',
                'message' => 'Update the information successfully!',
                'data'    => $result
            ];
            return $response;
        }
        $response = [
            'result'  => 'Error',
            'message' => 'Please check your information.',
            'data'    => null
            ];
       return $response;

    }

    /**
     * 欲刪除某客戶訂購資訊
     * @param Request $request
     * @param $id
     * @return array
     */
    public function destroy(Request $request, $id)
    {
        #如果有輸入客戶名稱,將依客戶名搜尋,否則將依照id搜尋
        if (isset($request->customer)) {
            $search_condition = [
                'customer' => $request->customer,
            ];
        } else {
            $search_condition = [
                'id' => $id
            ];
        }
        #執行資料刪除
        $result = $this->customerProduct->deleteInfo($search_condition);
        if ($result !== 0) {
            $response = [
                'result'  => 'OK',
                'message' => 'Deleted the information successfully!',
                'data'    => null
            ];
            return $response;
        }
        $response = [
            'result'  => 'Error',
            'message' => 'Please check your information.',
            'data'    => null
        ];
        return $response;

    }

    /**
     * 定義防呆程式以確認輸入資料欄位都有填入
     * @param $request
     * @return array
     */
    private function checkIfExistData($request)
    {
        if (!isset($request->customer)) {
            return [
                'result'  => 'Error',
                'message' => '沒有輸入客戶名稱',
                'data'    => null
            ];
        }
        if (!isset($request->material)){
            return [
                'result'  => 'Error',
                'message' => '沒有輸入材質名稱',
                'data'    => null
            ];
        }
        if (!isset($request->telephone)) {
            return [
                'result'  => 'Error',
                'message' => '沒有輸入客戶電話',
                'data'    => null
            ];
        }
        if (!isset($request->thickness)) {
            return [
                'result'  => 'Error',
                'message' => '沒有輸入商品厚度',
                'data'    => null
            ];
        }
        if (!isset($request->width)) {
            return [
                'result'  => 'Error',
                'message' => '沒有輸入商品寬度',
                'data'    => null
            ];
        }
        if (!isset($request->length)) {
            return [
                'result'  => 'Error',
                'message' => '沒有輸入商品長度',
                'data'    => null
            ];
        }
        if (!isset($request->quantity)) {
            return [
                'result'  => 'Error',
                'message' => '沒有輸入訂購數量',
                'data'    => null
            ];
        }
        if (!isset($request->shipment_date)) {
            return [
                'result'  => 'Error',
                'message' => '沒有輸入出貨日期',
                'data'    => null
            ];
        }
        return [
            'result'  => 'OK',
            'message' => 'Check entry ok!',
            'data'    => null
        ];

    }


}
