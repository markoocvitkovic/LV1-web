<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include("DataManager.php");
    $url = "https://stup.ferit.hr/index.php/zavrsni-radovi/page/";
    $dm = new DataManager($url);
    $dm->fetchData();
    echo $dm->getRadovi()->read();
    $dm->getRadovi()->finish();
    ?>
</body>
</html>