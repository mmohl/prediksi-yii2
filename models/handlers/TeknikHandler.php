<?php

/**
 * Description of TeknikHandler
 *
 * @author mmohl
 */

namespace app\models\handlers;

class TeknikHandler extends \app\models\Teknik {

    /**
     *
     * @param type $type
     * @param type $column
     * @return type
     * @throws Exception
     */
    public static function getParents($type = 'object', $column = 'name') {

        $columns = ['name' => 'nama_teknik', 'code' => 'kode', 'id' => 'id'];

        $col = $columns[$column];

        if (empty($col)) {
            throw new Exception(\Yii::t('app', 'nama kolom tidak tersedia'));
        }

        $tmp = self::find()->where(['parent' => null])->orderBy($col)->all();

        if ($type === 'dropdown') {
            return array_map(function($parent) use($col) {
                return ['value' => $parent->{$col}];
            }, $tmp);
        } elseif ($type === 'array') {
            return array_map(function($parent) use($col) {
                return $parent->{$col};
            }, $tmp);
        } elseif ($type === 'object') {
            return $tmp;
        } else {
            throw new Exception(\Yii::t('app', 'tipe tidak tersedia'));
        }
    }

    /**
     *
     * @param string $name
     * @return string
     */
    public static function autoCode($name) {
        $parent = self::getParent($name);

        $last = self::getLast($parent->id);

        $code = empty($last) ? $parent->kode . '1' : $parent->kode . (intval(ltrim($last->kode, $parent->kode)) + 1);

        return $code;
    }

    public static function getParent($name) {
        return self::find()->where(['nama_teknik' => $name])->one();
    }

    public static function getLast($id) {
        return self::find()->where(['parent' => $id])->orderBy(['id' => SORT_DESC])->one();
    }

    public static function getCodes($type = 'object', $custom = '') {
        $tmp = self::find();

        $column = empty($custom) ? 'kode' : $custom;

        if (!empty($custom)) {
            $tmp->select([$column]);
        }

        $codes = $tmp->all();

        if ($type === 'array') {
            return array_map(function($code) use($column) {
                return $code->{$column};
            }, $codes);
        }


        return $codes;
    }

}
