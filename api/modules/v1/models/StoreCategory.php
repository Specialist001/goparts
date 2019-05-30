<?php
namespace api\modules\v1\models;
use common\models\StoreCategory as Category;
use \yii\db\ActiveRecord;
/**
 * StoreCategory Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class StoreCategory extends Category
{
	/**
	 * @inheritdoc
	 */
//	public static function tableName()
//	{
//		return 'country';
//	}

    /**
     * @inheritdoc
     */
    public static function primaryKey()
    {
        return ['id'];
    }

    /**
     * Define rules for validation
     */
//    public function rules()
//    {
//        return [
//            [['code', 'name', 'population'], 'required']
//        ];
//    }
}
