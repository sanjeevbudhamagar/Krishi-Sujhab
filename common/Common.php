<?php
/**
 * Created by PhpStorm.
 * User: sanjeev-budha
 * Date: 4/21/16
 * Time: 9:24 PM
 */

require('../config/databaseConnection.php');

class Common {

    public function login($email,$pwd){

        global $connection;

        $pwd = md5($pwd);

        $login_query = "SELECT *FROM user WHERE email_address = '$email' and password='$pwd' ";

        $result = mysqli_query($connection,$login_query);

        $data = array();

        if(mysqli_num_rows($result)>0){

            $data['message']='success';

            while($row = mysqli_fetch_assoc($result)){
                $data['first_name'] = $row['first_name'];
                $data['last_name'] = $row['last_name'];
                $data['role'] = $row['role'];
                $data['id'] = $row['id'];
            }

        }
        else{
            $data['message']='fail';
        }

        return $data;

    }

    public function getBreed(){

        global $connection;

        $result = mysqli_query($connection,"SELECT  *FROM breed");
        $data = array();
        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['image'] = $row["image"];
            $data[$i]['breed_name'] = $row["breed_name"];
            $data[$i]['origin_distribution'] = $row["origin_distribution"];
            $data[$i]['character'] = $row["breed_character"];
            $data[$i]['utility'] = $row["utility"];
            $i++;
        }
        return $data;
    }

    public function createBreed($origin_distribution,$breed_name,$character,$image,$utility,$searchKeyword){

        global $connection;

        $created_date = date("Y-m-d");

        $create_breed = "INSERT INTO breed(breed_name,origin_distribution,breed_character,utility,image,created_date,search_words) VALUES('$breed_name','$origin_distribution','$character','$utility','$image','$created_date','$searchKeyword')";

        $result = mysqli_query($connection,$create_breed);

        $data = array();

        if(mysqli_num_rows($result)>0){
            $data['message']='success';
        }else{
            $data['message']='error';
        }

        return $data;
    }

    public function editBreed($id){

        global $connection;

        $select_query = "SELECT *FROM breed WHERE id ='$id'; ";

        $result = mysqli_query($connection,$select_query);

        $data = array();

        while($row = mysqli_fetch_assoc($result))
        {
            $data['id'] = $row["id"];
            $data['image'] = $row["image"];
            $data['breed_name'] = $row["breed_name"];
            $data['origin_distribution'] = $row["origin_distribution"];
            $data['breed_character'] = $row["breed_character"];
            $data['utility'] = $row["utility"];
        }
        return $data;

    }

    public function deleteBreed($id){

        global $connection;

        $delete_breed = "DELETE FROM breed WHERE id='$id' ";

        $result = mysqli_query($connection,$delete_breed);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='error';
        }

        return $data;

    }

    public function updateBreed($origin_distribution,$breed_name,$character,$image,$utility,$b_id){

        global $connection;

        $update_date = date("Y-m-d");

        $update_breed = "UPDATE breed SET breed_name = '$breed_name',origin_distribution='$origin_distribution',breed_character='$character',utility='$utility',image='$image',updated_date='$update_date' WHERE id='$b_id' ";
        $result = mysqli_query($connection,$update_breed);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='fail';
        }

        return $data;
    }

    public function checkDuplicate($input_text,$column_name,$table_name){
        
        global $connection;

        $select_query = "SELECT $column_name FROM $table_name";

        $result = mysqli_query($connection,$select_query);

        $data = array();

        $i = 0;

        while($row = mysqli_fetch_assoc($result)){
            $data[$i][$column_name] = $row[$column_name];
            $i++;
        }

        for($i = 0; $i < mysqli_num_rows($result);$i++){
            if($input_text == $data[$i][$column_name]){
                return true;
            }
        }
        return false;
    }

    public function getFood(){

        global $connection;

        $result = mysqli_query($connection,"SELECT  *FROM feed");
        $data = array();
        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['title'] = $row["title"];
            $data[$i]['description'] = $row["description"];
            $data[$i]['image'] = $row["image"];
            $i++;
        }
        return $data;
    }

    public function createFood($foodName,$description,$image){

        global $connection;

        $created_date = date("Y-m-d");

        $create_food = "INSERT INTO feed(title,description,image,created_date) VALUES('$foodName','$description','$image','$created_date')";

        $result = mysqli_query($connection,$create_food);

        $data = array();

        if($result){
            $data['message']='success';
        }
        else{
            $data['message']='fail';
        }

        return $data;
    }

    public function deleteFood($id){

        global $connection;

        $delete_food = "DELETE FROM feed WHERE id='$id' ";

        $result = mysqli_query($connection,$delete_food);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='error';
        }

        return $data;
    }

    public function editFood($id){

        global $connection;

        $select_query = "SELECT *FROM feed WHERE id ='$id'; ";

        $result = mysqli_query($connection,$select_query);

        $data = array();

        while($row = mysqli_fetch_assoc($result))
        {
            $data['id'] = $row["id"];
            $data['title'] = $row["title"];
            $data['description'] = $row["description"];
            $data['image'] = $row["image"];
        }

        return $data;
    }

    public function updateFood($food_name,$description,$image,$f_id){

        global $connection;

        $update_date = date("Y-m-d");

        $update_feed = "UPDATE feed SET title = '$food_name',description='$description',image='$image',updated_date='$update_date' WHERE id='$f_id' ";

        $result = mysqli_query($connection,$update_feed);

        $data = array();

        if($result){
            $data['message'] = 'success';
        }
        else{
            $data['message'] = 'fail';
        }

        return $data;

    }

    public function getDisease(){

        global $connection;

        $result = mysqli_query($connection,"SELECT  *FROM disease");
        $data = array();
        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['disease_name'] = $row["disease_name"];
            $data[$i]['description'] = $row["description"];
            $data[$i]['picture'] = $row["picture"];
            $i++;
        }
        return $data;

    }

    public function createDisease($disease_name,$description,$image){

        global $connection;

        $created_date = date("Y-m-d");

        $create_disease = "INSERT INTO disease(disease_name,description,picture,created_date) VALUES('$disease_name','$description','$image','$created_date')";

        $result = mysqli_query($connection,$create_disease);

        $data = array();

        if($result){
            $data['message']='success';
        }
        else{
            $data['message']='fail';
        }

        return $data;
    }


    public function deleteDisease($id){

        global $connection;

        $delete_disease = "DELETE FROM disease WHERE id='$id' ";

        $result = mysqli_query($connection,$delete_disease);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='error';
        }

        return $data;

    }

    public function editDisease($id){

        global $connection;

        $select_query = "SELECT *FROM disease WHERE id ='$id'; ";

        $result = mysqli_query($connection,$select_query);

        $data = array();

        while($row = mysqli_fetch_assoc($result))
        {
            $data['id'] = $row["id"];
            $data['disease_name'] = $row["disease_name"];
            $data['description'] = $row["description"];
            $data['picture'] = $row["picture"];
        }

        return $data;
    }

    public function updateDisease($disease_name,$description,$picture,$id){

        global $connection;

        $update_date = date("Y-m-d");

        $update_disease = "UPDATE disease SET disease_name = '$disease_name',description='$description',picture='$picture',update_date='$update_date' WHERE id='$id' ";

        $result = mysqli_query($connection,$update_disease);

        $data = array();

        if($result){
            $data['message'] = 'success';
        }
        else{
            $data['message'] = 'fail';
        }

        return $data;

    }

    public function getCure(){

        global $connection;

        $result = mysqli_query($connection,"SELECT  *FROM cure");
        $data = array();
        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['disease_id'] = $row["disease_id"];
            $data[$i]['preventive_care'] = $row["preventive_care"];
            $i++;
        }
        return $data;

    }

    public function createCure($id,$preventive){

        global $connection;

        $created_date = date("Y-m-d");

        $create_cure = "INSERT INTO cure(disease_id,preventive_care,created_date) VALUES('$id','$preventive','$created_date') ";

        $result = mysqli_query($connection,$create_cure);

        $data = array();

        if($result){
            $data['message']='success';
        }
        else{
            $data['message']='fail';
        }

        return $data;

    }

    public function getDiseaseNameById($id){

        global $connection;

        $result = mysqli_query($connection,"SELECT  *from disease WHERE id = '$id' ");

        $data = "";
        while($row = mysqli_fetch_assoc($result))
        {
            $data = $row["disease_name"];
        }

        return $data;

    }

    public function deleteCure($id){

        global $connection;

        $delete_cure = "DELETE FROM cure WHERE id='$id' ";

        $result = mysqli_query($connection,$delete_cure);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='error';
        }

        return $data;
    }

    public function editCure($id){

        global $connection;

        $select_query = "SELECT *FROM cure WHERE id ='$id'; ";

        $result = mysqli_query($connection,$select_query);

        $data = array();

        while($row = mysqli_fetch_assoc($result))
        {
            $data['id'] = $row["id"];
            $objCommon = new Common();
            $data['disease_name'] = $objCommon->getDiseaseName($row["disease_id"]);
            $data['preventive_care'] = $row["preventive_care"];
        }

        return $data;

    }

    public function getDiseaseName($id){

        global $connection;

        $select_query = "SELECT *FROM disease WHERE id ='$id'; ";

        $result = mysqli_query($connection,$select_query);

        while($row = mysqli_fetch_assoc($result))
        {
             $data = $row["disease_name"];
        }

        return $data;

    }

    public function updateCure($disease_id,$preventive,$id){

        global $connection;

        $update_date = date("Y-m-d");

        $update_cure = "UPDATE cure SET disease_id = '$disease_id',preventive_care='$preventive',updated_date='$update_date' WHERE id='$id' ";

        $result = mysqli_query($connection,$update_cure);

        $data = array();

        if($result){
            $data['message'] = 'success';
        }
        else{
            $data['message'] = 'fail';
        }

        return $data;
    }

    public function getShed(){

        global $connection;

        $result = mysqli_query($connection,"SELECT  *FROM shed");
        $data = array();
        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['title'] = $row["shed_title"];
            $data[$i]['photo'] = $row["photo"];
            $data[$i]['description'] = $row["description"];
            $i++;
        }
        return $data;
    }

    public function createShed($shed_title,$image,$description){

        global $connection;

        $created_date = date("Y-m-d");

        $create_shed = "INSERT INTO shed(shed_title,description,photo,created_date) VALUES('$shed_title','$description','$image','$created_date')";

        $result = mysqli_query($connection,$create_shed);

        $data = array();

        if($result){
            $data['message']='success';
        }
        else{
            $data['message']='fail';
        }

        return $data;
    }

    public function deleteShed($id){

        global $connection;

        $delete_shed = "DELETE FROM shed WHERE id='$id' ";

        $result = mysqli_query($connection,$delete_shed);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='error';
        }

        return $data;

    }

    public function editShed($id){

        global $connection;

        $select_query = "SELECT *FROM shed WHERE id ='$id'; ";

        $result = mysqli_query($connection,$select_query);

        $data = array();

        while($row = mysqli_fetch_assoc($result))
        {
            $data['id'] = $row["id"];
            $data['image'] = $row["photo"];
            $data['shed_title'] = $row["shed_title"];
            $data['description'] = $row["description"];

        }
        return $data;

    }

    public function updateShed($description,$image,$shed_title,$s_id){

        global $connection;

        $update_date = date("Y-m-d");

        $update_shed = "UPDATE shed SET description='$description',photo='$image',update_date='$update_date',shed_title='$shed_title' WHERE id='$s_id' ";
        $result = mysqli_query($connection,$update_shed);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='fail';
        }

        return $data;
    }

    public function createQuery($fullName,$phoneNumber,$email,$address,$query){

        global $connection;

        $created_date = date("Y-m-d");

        $create_query = "INSERT INTO query(full_name,phone_number,email,address,query,created_date) VALUES('$fullName','$phoneNumber','$email','$address','$query','$created_date')";

        $result = mysqli_query($connection,$create_query);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='fail';
        }

        return $create_query;
    }

    public function getQuery(){

        global $connection;

        $result = mysqli_query($connection,"SELECT  *FROM query");
        $data = array();
        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['full_name'] = $row["full_name"];
            $data[$i]['phone_number'] = $row["phone_number"];
            $data[$i]['email'] = $row["email"];
            $data[$i]['address'] = $row["address"];
            $data[$i]['query'] = $row["query"];
            $data[$i]['created_date'] = $row["created_date"];
            $i++;
        }
        return $data;
    }

    public function deleteQuery($id){
        
        global $connection;

        $delete_query = "DELETE FROM query WHERE id='$id' ";

        $result = mysqli_query($connection,$delete_query);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='error';
        }

        return $data;
    }

    public function replyQuery($id,$reply,$replyFrom){

        global $connection;

        $replied_date = date("Y-m-d");
        $reply_query = "INSERT INTO reply(reply,reply_from,reply_to_query,replied_date) VALUES('$reply','$replyFrom','$id','$replied_date')";

        $result = mysqli_query($connection,$reply_query);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='error';
        }

        return $data;
    }

    public function countReply($id){

        global $connection;

        $select_reply_id = "SELECT *from reply WHERE reply_to_query='$id'";

        $result = mysqli_query($connection,$select_reply_id);

        return mysqli_num_rows($result);
    }

    public function getReplyList($id){

        global $connection;

        $result = mysqli_query($connection,"SELECT  *FROM reply WHERE reply_to_query='$id'");

        $data = array();
        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['reply'] = $row["reply"];
            $data[$i]['reply_from'] = $row["reply_from"];
            $data[$i]['replied_date'] = $row["replied_date"];
            $i++;
        }
        return $data;
    }


    public function getUser(){

        global $connection;

        $result = mysqli_query($connection,"SELECT  *FROM user");

        $data = array();
        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['first_name'] = $row["first_name"];
            $data[$i]['last_name'] = $row["last_name"];
            $data[$i]['city'] = $row["city"];
            $data[$i]['zone'] = $row["zone"];
            $data[$i]['district'] = $row["district"];
            $data[$i]['mobile_number'] = $row["mobile_number"];
            $data[$i]['email_address'] = $row["email_address"];
            $data[$i]['role'] = $row["role"];
            $data[$i]['image'] = $row['image'];
            $i++;
        }
        return $data;
    }

    public function deleteUser($id){

        global $connection;

        $delete_user = "DELETE FROM user WHERE id='$id' ";

        $result = mysqli_query($connection,$delete_user);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='error';
        }

        return $data;
    }

    public function createUser($firstName,$lastName,$mobileNumber,$emailAddress,$city,$zone,$district,$role,$profilePicture){

        global $connection;

        $created_date = date("Y-m-d");
        $password = md5('123');

        $create_user = "INSERT INTO user(first_name,last_name,city,zone,district,mobile_number,email_address,password,role,image,created_date) VALUES('$firstName','$lastName','$city','$zone','$district','$mobileNumber','$emailAddress','$password','$role','$profilePicture','$created_date')";

        $result = mysqli_query($connection,$create_user);
        $data = array();

        if($result){
            $data['password']=$password;
            $data['message']='success';
        }else{
            $data['message']='fail';
        }

        return $data;
    }

    public function changePassword($password,$user_id){
        global $connection;

        $password = md5($password);

        $change_password = "update user set password = '$password' where id = '$user_id'";

        $result = mysqli_query($connection,$change_password);

        if($result){
            return true;
        }

        return false;

    }

    public function randomPassword(){

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public function getUserByEmail($email){
        global $connection;

        $result = mysqli_query($connection,"SELECT  *FROM user WHERE email_address='$email'");

        $data = array();

        while($row = mysqli_fetch_assoc($result))
        {
            $data['first_name'] = $row["first_name"];
            $data['last_name'] = $row["last_name"];

        }

        return $data['first_name'].' '.$data['last_name'];
    }

    public function editUser($id){
        global $connection;

        $select_query = "SELECT *FROM user WHERE id ='$id'; ";

        $result = mysqli_query($connection,$select_query);

        $data = array();

        while($row = mysqli_fetch_assoc($result))
        {
            $data['id'] = $row["id"];
            $data['first_name'] = $row["first_name"];
            $data['last_name'] = $row["last_name"];
            $data['city'] = $row["city"];
            $data['zone'] = $row["zone"];
            $data['district'] = $row["district"];
            $data['mobile_number'] = $row["mobile_number"];
            $data['email_address'] = $row["email_address"];
            $data['role'] = $row["role"];
            $data['image'] = $row["image"];
        }
        return $data;

    }

    public function updateUser($firstName, $lastName, $mobileNumber, $emailAddress, $city, $zone, $district, $role, $image,$id){

        global $connection;

        $updated_date = date("Y-m-d");

        $create_user = "update user set first_name = '$firstName',last_name='$lastName',city='$city',zone='$zone',district='$district',mobile_number='$mobileNumber',email_address='$emailAddress',role = '$role',image='$image',updated_date='$updated_date' WHERE id = '$id'";

        $result = mysqli_query($connection,$create_user);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='fail';
        }

        return $data;
    }

    public function getDiseaseById($id){

        global $connection;

        $result = mysqli_query($connection,"SELECT  *FROM disease WHERE id='$id'");
        $data = array();
        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data['id'] = $row["id"];
            $data['disease_name'] = $row["disease_name"];
            $data['description'] = $row["description"];
            $data['picture'] = $row["picture"];
            $i++;
        }
        return $data;

    }

    public function resetPassword($id){

        global $connection;

        $password = md5('123');

        $result = mysqli_query($connection,"update user set password = '$password' where id='$id' ");

        $data = array();

        if($result){
            $data['message'] = 'success';
        }
        else{
            $data['message'] = 'fail';
        }

        return $data;
    }

    public function getDiseaseList(){

        global $connection;

        $result = mysqli_query($connection,"SELECT  *FROM disease_table");

        $data = array();

        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['s1'] = $row["s1"];
            $data[$i]['s2'] = $row["s2"];
            $data[$i]['s3'] = $row["s3"];
            $data[$i]['s4'] = $row["s4"];
            $data[$i]['s5'] = $row["s5"];
            $data[$i]['s6'] = $row["s6"];
            $data[$i]['s7'] = $row["s7"];
            $data[$i]['s8'] = $row["s8"];
            $data[$i]['s9'] = $row["s9"];
            $data[$i]['s10'] = $row["s10"];
            $data[$i]['s11'] = $row["s11"];
            $data[$i]['s12'] = $row["s12"];
            $data[$i]['s13'] = $row["s13"];
            $data[$i]['classifier'] = $row["classifier"];
            $i++;
            
        }
        return $data;
    }
}