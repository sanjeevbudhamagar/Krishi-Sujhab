<?php
/**
 * Created by PhpStorm.
 * User: Arun Tamang
 * Date: 7/25/2016
 * Time: 3:27 PM
 */


require('../common/Common.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>बाख्रा ज्ञान </title>
    <meta charset="utf-8">
    <link rel="icon" href="../images/logo.png" type="image/gif" sizes="16x16">

</head>

<body>
<?php
require('../views/Layout/header.php');
?>

<?php

$foodList = array();
$objCommon = new Common();
$foodList = $objCommon->getFood()
?>


<div class="container">

    <?php
    if(count($foodList)>0){
    foreach($foodList as $food){
        ?>
<!--        <div class="panel">-->

            <div class="col-sm-8">
                <h3><?php echo $food['title'] ?></h3>
                <?php

                    $descriptionList = explode('->',$food['description'])

                    ?>
                    <ul>
                    <?php
                        for($i = 1;$i < count($descriptionList);$i++){
                    ?>
                        <li><?php echo $descriptionList[$i] ?></li>

                    <?php } ?>
                    </ul>

            </div>

            <div class="col-sm-4">
                <img class="img-thumbnail" src="../images/<?php echo $food["image"] ?>" style="height: 200px;width:200px;">
            </div>

<!--        </div>-->

    <?php } }
        else{
    ?>
    <p>आहाराबारे कुनै पनि जानकारी भेटिएन|</p>

    <?php } ?>
</div>

<?php
require('../views/Layout/footer.php');
?>
</body>
</html>