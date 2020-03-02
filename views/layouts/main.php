<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            ['label' => '<span class="glyphicon glyphicon-home"></span>&nbsp;Inicio', 'url' => ['/site/index']],
            ['label' => '<span class="glyphicon glyphicon-ok"></span>&nbsp;Ofertas', 'url' => ['/site/ofertas']],
            ['label' => '<span class="glyphicon glyphicon-th"></span>&nbsp;Productos', 'url' => ['/site/productos']],
            ['label' => '<span class="glyphicon glyphicon-list"></span>&nbsp;Categorías', 'url' => ['/site/categorias']],
            ['label' => '<span class="glyphicon glyphicon-info-sign"></span>&nbsp;Nosotros', 'items' => [
                    ['label' => 'Donde Estamos', 'url' => ['/site/dondeestamos']],
                    ['label' => 'Quienes Somos', 'url' => ['/site/quienessomos']],
                    ['label' => 'Nuestros productos', 'url' => ['/site/nuestrosproductos']],
                    '<li class="divider"></li>',
                    ['label' => 'Informacion', 'url' => ['/site/informacion']],
            ]],
            ['label' => '<span class="glyphicon glyphicon-user"></span>&nbsp;Contacto', 'url' => ['/site/contacto']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Oscar Megía López 2020</p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
