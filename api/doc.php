<?php
/**
 * Created by PhpStorm.
 * User: samlv
 * Date: 2016/12/5
 * Time: 13:16
 */
$api_base = 'http://movesun.com';
$apis = include_once("apis.php");
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>天网舆情环境</title>
    <link rel="stylesheet" href="common.css">
</head>
<body>
<?php foreach ($apis as $api): ?>
    <dl>
        <dt>接口名</dt>
        <dd><?= $api['name']; ?></dd>
        <dt>说明</dt>
        <dd><?=$api['explain']?></dd>
        <dt>URL</dt>
        <dd><?= $api['url']; ?></dd>
        <dt>请求类型</dt>
        <dd><?= $api['request_type']; ?></dd>
        <dt>参数类型</dt>
        <dd><?= $api['param_type']; ?></dd>
        <dt>参数列表</dt>
        <dd>
            <table class="altrowstable" id="alternatecolor">
                <thead>
                <tr>
                    <th>参数</th>
                    <th>名称</th>
                    <th>Required</th>
                    <th>类型</th>
                    <th>说明</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($api['params'] as $param => $paramData): ?>
                    <tr>
                        <td><?= $param; ?></td>
                        <td><?= $paramData['name']; ?></td>
                        <td><?= isset($paramData['required']) ? $paramData['required'] : true; ?></td>
                        <td><?= isset($paramData['type']) ? $paramData['type'] : 'string'; ?></td>
                        <td><?= $paramData['mark']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </dd>
        <dt>响应类型</dt>
        <dd><?= $api['resp_type']; ?></dd>
        <dt>成功响应</dt>
        <dd>
            <code>
                <?= $api['success_resp']; ?>
            </code>
        </dd>
        <dt>失败响应</dt>
        <dd>
            <code>
                <?= $api['error_resp']; ?>
            </code>
        </dd>
    </dl>
<?php endforeach; ?>
<script type="text/javascript">
    function altRows(id) {
        if (document.getElementsByTagName) {
            var table = document.getElementById(id);
            var rows = table.getElementsByTagName("tr");

            for (var i = 0; i < rows.length; i++) {
                rows[i].className = i % 2 == 0 ? 'evenrowcolor' : 'oddrowcolor';
            }
        }
    }
    window.onload = function () {
        altRows('alternatecolor');
    }
</script>
</body>
</html>
