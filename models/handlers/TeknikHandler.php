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
     * @param string $name
     * @param boolean $toJson
     * @return array
     */
    public static function getParents($name = null, $toJson = false) {
        $tmp = self::find()->where(['LIKE', 'nama_teknik', $name])->orderBy('nama_teknik')->all();

        if ($toJson) {
            return array_map(function($parent) {
                return ['value' => $parent->nama_teknik];
            }, $tmp);
        } else {
            return $tmp;
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

}
