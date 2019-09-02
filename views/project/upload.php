<?php

use App\Asset\LayUI;

/** @var \yii\web\View $this */

LayUI::register($this);

$this->registerJs($this->render('upload.js'), \yii\web\View::POS_END);
 ?>


<form action="/project/download" class="layui-form" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label">上传文件</label>
        <div class="layui-input-block">
            <div id="upload-box" class="upload-box">
                <div class="layui-upload-drag">
                    <i class="layui-icon"></i>
                    <p>点击上传，或将文件拖拽到此处</p>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">已上传的文件</label>
        <div class="layui-input-block">
            <input type="text" id="upload-file" name="filename" required placeholder="选择文件并上传" autocomplete="off" class="layui-input" readonly> 
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button type="submit" class="layui-btn">下载 Markdown</button>
        </div>
    </div>
</form>
