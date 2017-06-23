<?php

use yii\helpers\Html;
use app\assets\LoginFormAsset;

LoginFormAsset::register($this);

$this->title = 'Login';
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body>
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>