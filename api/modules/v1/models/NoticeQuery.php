<?php
namespace api\modules\v1\models;

/**
 * This is the ActiveQuery class for [[Notice]].
 *
 * @see News
 */
class NoticeQuery extends \yii\db\ActiveQuery
{

    /*
     * public function active()
     * {
     * return $this->andWhere('[[status]]=1');
     * }
     */
    
    /**
     * @inheritdoc
     * 
     * @return Notice[]|array
     */
    public function all($db = null)
    {
        $models = parent::all($db);
        \array_walk($models, function (&$v) {
            if (isset($v->create_at)) {
                $v->create_at = date("Y-m-d", \strtotime($v->create_at));
            }
        });
        return $models;
    }

    /**
     * @inheritdoc
     * 
     * @return Notice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
