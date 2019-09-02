layui.use(['upload'], function () {
    var upload = layui.upload;

    upload.render({
        elem: "#upload-box",
        url: "",
        accept: "file",
        exts: "json",
        drag: true,
        done: function (res) {
            if (res.code != 0) {
                layer.msg('上传失败', {icon:2});
                return ;
            }
            document.querySelector("#upload-file").value = res.name;
            layer.msg('上传成功', {icon:1});
        },
        error: function () {
            layer.msg('文件上传失败', {icon:2});
        },
    });
});
