<?php 
// start session 
session_start(); 
 
// include and initialize DB class 
require_once 'DB.class.php'; 
$db = new DB(); 
 
// database table name 
$tblName = 'users'; 
 
$postData = $statusMsg = $valErr = ''; 
$status = 'danger'; 
$redirectURL = 'index.php'; 
 
// if Add request is submitted 
if(!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'add'){ 
    $redirectURL = 'add.php'; 
     
    // get user's input 
    $postData = $_POST; 
    $name = !empty($_POST['name'])?trim($_POST['name']):''; 
    $email = !empty($_POST['email'])?trim($_POST['email']):''; 
    $phone = !empty($_POST['phone'])?trim($_POST['phone']):''; 
     
    // validate form fields 
    if(empty($name)){ 
        $valErr .= 'Please enter your name.<br/>'; 
    } 
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){ 
        $valErr .= 'Please enter a valid email.<br/>'; 
    } 
    if(empty($phone)){ 
        $valErr .= 'Please enter your phone no.<br/>'; 
    } 
     
    // check whether user inputs are empty 
    if(empty($valErr)){ 
        // insert data into the database 
        $userData = array( 
            'name' => $name, 
            'email' => $email, 
            'phone' => $phone 
        ); 
        $insert = $db->insert($tblName, $userData); 
         
        if($insert){ 
            $status = 'success'; 
            $statusMsg = 'Os datos do usuario se engadiron con éxito!'; 
            $postData = ''; 
             
            $redirectURL = 'index.php'; 
        }else{ 
            $statusMsg = 'Algo foi mal, intentao de novo dentro dun pouco.'; 
        } 
    }else{ 
        $statusMsg = '<p>Por favor cubre tódolos eidos requiridos:</p>'.trim($valErr, '<br/>'); 
    } 
     
    // store status into the SESSION 
    $sessData['postData'] = $postData; 
    $sessData['status']['type'] = $status; 
    $sessData['status']['msg'] = $statusMsg; 
    $_SESSION['sessData'] = $sessData; 
}elseif(!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'edit' && !empty($_POST['id'])){ // If Edit request is submitted 
    $redirectURL = 'edit.php?id='.$_POST['id']; 
     
    // get user's input 
    $postData = $_POST; 
    $name = !empty($_POST['name'])?trim($_POST['name']):''; 
    $email = !empty($_POST['email'])?trim($_POST['email']):''; 
    $phone = !empty($_POST['phone'])?trim($_POST['phone']):''; 
     
    // validate form fields 
    if(empty($name)){ 
        $valErr .= 'Por favor cubre teu nome.<br/>'; 
    } 
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){ 
        $valErr .= 'Por favor usa un email válido.<br/>'; 
    } 
    if(empty($phone)){ 
        $valErr .= 'Por favor proporciona o teu numero de teléfono.<br/>'; 
    } 
     
    // check whether user inputs are empty 
    if(empty($valErr)){ 
        // update data in the database 
        $userData = array( 
            'name' => $name, 
            'email' => $email, 
            'phone' => $phone 
        ); 
        $conditions = array('id' => $_POST['id']); 
        $update = $db->update($tblName, $userData, $conditions); 
         
        if($update){ 
            $status = 'success'; 
            $statusMsg = 'Os datos do usuario foron actualizados con éxito!'; 
            $postData = ''; 
             
            $redirectURL = 'index.php'; 
        }else{ 
            $statusMsg = 'Algo foi mal, intentao de novo dentro dun pouco.'; 
        } 
    }else{ 
        $statusMsg = '<p>Por favor cubre tódolos eidos requiridos:</p>'.trim($valErr, '<br/>'); 
    } 
     
    // store status into the SESSION 
    $sessData['postData'] = $postData; 
    $sessData['status']['type'] = $status; 
    $sessData['status']['msg'] = $statusMsg; 
    $_SESSION['sessData'] = $sessData; 
}elseif(!empty($_REQUEST['action_type']) && $_REQUEST['action_type'] == 'delete' && !empty($_GET['id'])){ // if Delete request is submitted 
    // delete data from the database 
    $conditions = array('id' => $_GET['id']); 
    $delete = $db->delete($tblName, $conditions); 
     
    if($delete){ 
        $status = 'success'; 
        $statusMsg = 'Os datos do usuario foron eliminados con éxito!'; 
    }else{ 
        $statusMsg = 'Algo foi mal, intentao de novo dentro dun pouco.'; 
    } 
     
    // Store status into the SESSION 
    $sessData['status']['type'] = $status; 
    $sessData['status']['msg'] = $statusMsg; 
    $_SESSION['sessData'] = $sessData; 
} 
 
// redirect to the home/add/edit page 
header("Location: $redirectURL"); 
exit;