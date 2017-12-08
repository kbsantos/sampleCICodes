<?php

header('Access-Control-Allow-Origin: *');

   $hn      = 'localhost';
   $un      = 'hubriz';
   $pwd     = '';
   $db      = 'resource_management';

   $cs      = 'utf8';

   // Set up the PDO parameters
   $dsn  = "mysql:host=" . $hn . ";port=3306;dbname=" . $db;
   $opt  = array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                       );

   $pdo  = new PDO($dsn, $un, $pwd, $opt);

   $data = array();
   $user_arr = array();

   // Sanitise URL supplied values
   $fname        = filter_var($_REQUEST['fname'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
   $lname        = filter_var($_REQUEST['lname'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
   $email        = filter_var($_REQUEST['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
   $address      = filter_var($_REQUEST['address'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
   $city         = filter_var($_REQUEST['city'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
   $username     = filter_var($_REQUEST['username'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
   $password     = filter_var($_REQUEST['password'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

    try {
            
      $sql  = "SELECT user_name FROM user_tbl where user_name = :username";

      $stmt =  $pdo->prepare($sql);
      $stmt->bindParam(':username', $username, PDO::PARAM_STR);
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_OBJ);
      // echo json_encode($row);
      if($row == false){
            // echo "no value";

            try {

               $sql  = "INSERT INTO user_tbl (lastname, firstname, email, address, city, user_name, user_password)
               VALUES(:lname, :fname, :email, :address, :city, :username, :password)";

               $stmt = $pdo->prepare($sql);

               $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
               $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
               $stmt->bindParam(':email', $email, PDO::PARAM_STR);
               $stmt->bindParam(':address', $address, PDO::PARAM_STR);
               $stmt->bindParam(':city', $city, PDO::PARAM_STR);
               $stmt->bindParam(':username', $username, PDO::PARAM_STR);
               $stmt->bindParam(':password', $password, PDO::PARAM_STR);
               $stmt->execute();

               // echo json_encode(array('message' => 'Congratulations the record '));

               try {

                  $sql  = "SELECT user_id FROM user_tbl where user_name = :username";
                  $stmt =  $pdo->prepare($sql);
                  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                  $stmt->execute();
            
                  // echo json_encode($row);
                  while($row  = $stmt->fetch(PDO::FETCH_OBJ)){
                     $data[] = $row;
                  }

                  // Return data as JSON
                  // echo json_encode(array('message' => 'user id', 'result' => $data));

               }catch(PDOException $e){
                  echo $e->getMessage();
               }

            }catch(PDOException $e){
               echo $e->getMessage();
            }


         // echo json_encode(array('message' => 'username has already taken by others', 'result' => $row));
             echo json_encode($data[0]);

      }else{
         // echo "has value";
         $user_arr[] = $row;
         echo json_encode(array('message' => 'username has already taken by others' , 'result' => $user_arr[0]));
      }

   }catch(PDOException $e){
      echo $e->getMessage();
   }

?>