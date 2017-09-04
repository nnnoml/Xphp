<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
</head>
<body>
    <?php
    foreach($data as $vo){
        echo $vo['item_title'];
        echo "<br />";
    }
    ?>
</body>
</html>
