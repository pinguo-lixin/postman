<?php
/** @var \yii\web\View $this */
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Postman Doc</title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <?=$content ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>
