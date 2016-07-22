<?php
/**
 * Created by PhpStorm.
 * User: Arun Tamang
 * Date: 7/22/2016
 * Time: 4:15 PM
 */

require('../common/Common.php');

$objCommon = new Common();

if(isset($_POST['mode'])){

    if($_POST["mode"]=="add"){


        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $description = $_POST['description'];
        $shed_title = $_POST['shedTitle'];
        move_uploaded_file($image_tmp,"../images/$image");


        $result = $objCommon->createShed($shed_title,$image,$description);

        if($result['message']=='success'){
            $_SESSION['add'] ="success";
        } else {
            $_SESSION['add'] ="error";
        }

        header('Location:../views/shed.php');
    }

    else if($_POST["mode"]=="edit"){

        $id = $_POST['id'];

        $result = array();
        $result = $objCommon->editBreed($id);

        echo json_encode($result);
    }

    else if($_POST["mode"]=="update"){

        $b_id = $_POST['breed_id'];
        $breed_name = $_POST['breedName'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $searchKeyword = $_POST['searchKeyword'];

        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($image_tmp,"../images/$image");

        $result = array();

        $result = $objCommon->updateBreed($category,$breed_name,$description,$image,$searchKeyword,$b_id);

        if($result['message']=='success'){

            header("Location:../views/breed.php");
        }

    }

    else if($_POST['mode']=='delete'){

        $id= $_POST['id'];

        $result = array();

        $result = $objCommon->deleteBreed($id);

        echo json_encode($result);
    }
}
