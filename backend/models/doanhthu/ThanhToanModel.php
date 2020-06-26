<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 16-May-19
 * Time: 10:46 AM
 */

namespace backend\models\doanhthu;

use backend\models\CustomerModel;
use backend\modules\baocao\models\doanhthu\BaoCaoDonHangModel;
use backend\modules\clinic\models\PhongKhamLoaiThanhToan;
use yii\db\ActiveRecord;

class ThanhToanModel extends ActiveRecord
{
    const THANH_TOAN = 0;
    const DAT_COC = 1;
    const HOAN_COC = 2;
    const THANHTOAN_TYPE = [
        self::THANH_TOAN => 'Thanh toán',
        self::DAT_COC => 'Đặt cọc',
        self::HOAN_COC => 'Hoàn cọc',
    ];

    public $tien;

    public $id_dich_vu;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'phong_kham_don_hang_w_thanh_toan';
    }

    public function getMoneyCustomerThanhToan($idThanhToan, $dc)
    {
        return self::find()->where(['phong_kham_don_hang_id' => $idThanhToan, 'tam_ung' => $dc])->sum('tien_thanh_toan');
    }

    public function getDonHangHasOne()
    {
        return $this->hasOne(BaoCaoDonHangModel::class, ['id' => 'phong_kham_don_hang_id']);
    }

    public function getCustomerHasOne()
    {
        return $this->hasOne(CustomerModel::class, ['id' => 'customer_id']);
    }

    public function getLoaiThanhToanHasOne()
    {
        return $this->hasOne(PhongKhamLoaiThanhToan::class, ['id' => 'loai_thanh_toan']);
    }

    public function getTamUng(){
        $arr = self::THANHTOAN_TYPE;
        return isset($arr[$this->tam_ung]) ? $arr[$this->tam_ung] : "";
    }

}
