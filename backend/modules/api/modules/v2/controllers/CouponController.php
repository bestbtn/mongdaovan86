<?php

namespace backend\modules\api\modules\v2\controllers;

use modava\affiliate\models\Customer;
use modava\affiliate\models\Payment;
use modava\affiliate\models\search\OrderSearch;
use modava\affiliate\models\search\CustomerSearch;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use modava\affiliate\models\Order;
use modava\affiliate\models\Receipt;
use Yii;
use backend\modules\api\modules\v2\components\RestfullController;
use modava\affiliate\models\Coupon;
use yii\web\Response;

class CouponController extends RestfullController
{
    public $modelClass = 'backend\modules\api\modules\v1\models\UserApi';

    public function actionCheckCode()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $code = \Yii::$app->request->get('code');

        $coupon = Coupon::checkCoupon($code);

        if ($coupon) {
            return [
                'success' => true,
                'message' => Yii::t('backend', 'Mã code do khách hàng {full_name} giới thiệu', ['full_name' => $coupon->customer->full_name]),
                'data' => $coupon->getAttributes()
            ];
        }

        return [
            'success' => false,
            'message' => Yii::t('backend', 'Mã code không tồn tại hoặc đã được sử dụng')
        ];
    }

    public function actionSaveOrderByPartnerCode()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $code = Yii::$app->request->post('partner_order_code');

        if ($code) {
            $model = Order::findOne(['partner_order_code' => $code]);
            if ($model === null) {
                $model = new Order();
            }
        } else {
            return [
                'success' => false,
                'error' => [
                    'code' => 400,
                    'message' => [
                        'partner_order_code' => 'partner_order_code Không được để trống'
                    ]
                ]
            ];
        }

        if ($model->loadFromApi(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return [
                'success' => true,
                'code' => 200,
                'data' => $model->getAttributes(),
            ];
        } else {
            if ($model->hasErrors('coupon_id')) {
                $model->clearErrors('coupon_id');

                if (Yii::$app->request->post('coupon_code')) {
                    $model->addError('coupon_code', 'Mã coupon không tồn tại hoặc đã được sử dụng');
                } else {
                    $model->addError('coupon_code', 'Mã coupon không được để trống');
                }
            }

            return [
                'success' => false,
                'error' => [
                    'code' => 400,
                    'message' => $model->getErrors()
                ]
            ];
        }
    }

    public function actionSaveOrder()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->get('id');

        if ($id) {
            $model = Order::findOne($id);
            if ($model === null) {
                return [
                    'success' => false,
                    'error' => [
                        'code' => 404,
                        'message' => "not found"
                    ]
                ];
            }
        } else {
            $model = new Order();
        }

        if ($model->loadFromApi(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return [
                'success' => true,
                'code' => 200,
                'data' => $model->getAttributes(),
            ];
        } else {
            if ($model->hasErrors('coupon_id')) {
                $model->clearErrors('coupon_id');

                if (Yii::$app->request->post('coupon_code')) {
                    $model->addError('coupon_code', 'Mã coupon không tồn tại hoặc đã được sử dụng');
                } else {
                    $model->addError('coupon_code', 'Mã coupon không được để trống');
                }
            }

            return [
                'success' => false,
                'error' => [
                    'code' => 400,
                    'message' => $model->getErrors()
                ]
            ];
        }
    }

    public function actionSavePayment()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->get('id');

        if ($id) {
            $model = Payment::findOne($id);
            if ($model === null) {
                return [
                    'success' => false,
                    'error' => [
                        'code' => 404,
                        'message' => "not found"
                    ]
                ];
            }
        } else {
            $model = new Payment();
        }

        if ($model->loadFromApi(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return [
                'success' => true,
                'code' => 200,
                'data' => $model->getAttributes(),
            ];
        } else {
            return [
                'success' => false,
                'error' => [
                    'code' => 400,
                    'message' => $model->getErrors()
                ]
            ];
        }
    }

    public function actionSaveReceipt()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->get('id');

        if ($id) {
            $model = Receipt::findOne($id);
            if ($model === null) {
                return [
                    'success' => false,
                    'error' => [
                        'code' => 404,
                        'message' => "not found"
                    ]
                ];
            }
        } else {
            $model = new Receipt();
        }

        if ($model->loadFromApi(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return [
                'success' => true,
                'code' => 200,
                'data' => $model->getAttributes(),
            ];
        } else {
            return [
                'success' => false,
                'error' => [
                    'code' => 400,
                    'message' => $model->getErrors()
                ]
            ];
        }
    }

    public function actionSaveReceiptByPartnerCode()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $code = Yii::$app->request->post('partner_code');

        if ($code) {
            $model = Receipt::findOne(['partner_code' => $code]);
            if ($model === null) {
                $model = new Receipt();
            }
        } else {
            return [
                'success' => false,
                'error' => [
                    'code' => 404,
                    'message' => "partner_code Không được để trống"
                ]
            ];
        }

        if ($model->loadFromApi(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return [
                'success' => true,
                'code' => 200,
                'data' => $model->getAttributes(),
            ];
        } else {
            return [
                'success' => false,
                'error' => [
                    'code' => 400,
                    'message' => $model->getErrors()
                ]
            ];
        }
    }

    public function actionDeleteRecord()
    {
        $target = Yii::$app->request->post('target');
        $id = Yii::$app->request->post('id');

        switch ($target) {
            case 'Receipt':
                $model = Receipt::findOne($id);
                break;
            case 'Order':
                $model = Order::findOne($id);
                break;
            case 'Payment':
                $model = Payment::findOne($id);
                break;
            default:
                $model = null;
                break;
        }

        if ($model == null) {
            return [
                'success' => false,
                'error' => [
                    'code' => 404,
                    'message' => [Yii::t('backend', '{target} không tồn tại', ['target' => $target])]
                ]
            ];
        }

        try {
            if ($model->delete()) {
                $code = 200;
                return [
                    'success' => true,
                    'code' => $code,
                    'message' =>  Yii::t('backend', 'Xóa thành công'),
                ];
            } else {
                $code = 406;
                $message = $model->getErrors();
                $status = false;
            }
        } catch (Exception $ex) {
            $code = 406;
            $message = [$ex->getMessage()];
            $status = false;
        }


        return [
            'success' => $status,
            'error' => [
                'message' => $message,
                'code' => $code,
            ]
        ];
    }

    public function actionDeleteRecordByPartnerCode()
    {
        $target = Yii::$app->request->post('target');
        $partnerCode = Yii::$app->request->post('code');

        switch ($target) {
            case 'Receipt':
                $model = Receipt::findOne(['partner_code' => $partnerCode]);
                break;
            case 'Order':
                $model = Order::findOne(['partner_order_code' => $partnerCode]);
                break;
            default:
                $model = null;
                break;
        }

        if ($model == null) {
            return [
                'success' => false,
                'error' => [
                    'code' => 400,
                    'message' => [Yii::t('backend', '{target} không tồn tại', ['target' => $target])]
                ]
            ];
        }

        try {
            if ($model->delete()) {
                $code = 200;
                $message = Yii::t('backend', 'Xóa thành công');
                $status = true;
            } else {
                $code = 406;
                $message = $model->getErrors();
                $status = false;
            }
        } catch (Exception $ex) {
            $code = 406;
            $message = [$ex->getMessage()];
            $status = false;
        }

        return [
            'success' => $status,
            'error' => [
                'code' => $code,
                'message' => $message
            ]
        ];
    }

    public function actionPayments($customerId)
    {
        if (!$customerId) {
            return [
                'success' => false,
                'error' => [
                    'code' => 400,
                    'message' => "customer-id is required"
                ]
            ];
        }

        if (!Customer::findOne($customerId)) {
            return [
                'success' => false,
                'error' => [
                    'code' => 404,
                    'message' => "Không tìm thấy khách hàng"
                ]
            ];
        }

        return [
            'success' => true,
            'data' => Payment::findByCustomer($customerId)
        ];
    }

    public function actionCustomers() {
        $model = new CustomerSearch();
        $dataProvider = $model->search(Yii::$app->request->get(), true);

        return [
            'success' => true,
            'data' => $dataProvider->getModels(),
            'total_count' => $dataProvider->getTotalCount()
        ];
    }

    public function actionGetOrdersByCustomer($customerId) {
        $order = new OrderSearch();
        $dataProvider = $order->search(Yii::$app->request->get(), $customerId,true);

        return [
            'success' => true,
            'data' => $dataProvider->getModels(),
            'total_count' => $dataProvider->getTotalCount()
        ];
    }

    public function actionGetRecord() {
        $target = Yii::$app->request->get('target');
        $id = Yii::$app->request->get('id');

        switch ($target) {
            case 'Receipt':
                $model = Receipt::findOne($id);
                break;
            case 'Order':
                $model = Order::findOne($id);
                break;
            case 'Customer':
                $model = Customer::findOne($id);
                break;
            case 'Payment':
                $model = Payment::findOne($id);
                break;
            default:
                $model = null;
                break;
        }

        if ($model == null) {
            return [
                'success' => false,
                'error' => [
                    'code' => 404,
                    'message' => [Yii::t('backend', '{target} không tồn tại', ['target' => $target])]
                ]
            ];
        }

        return [
            'success' => true,
            'data' => $model->getAttributes(),
            'code' => 200,
        ];
    }
}