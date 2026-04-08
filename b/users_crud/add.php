<?php 
// Start session 
session_start(); 
 
// Get data from session 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
 
// Get status from session 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $status = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
 
// Get submitted form data  
$postData = array(); 
if(!empty($sessData['postData'])){ 
    $postData = $sessData['postData']; 
    unset($_SESSION['postData']); 
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP OOP CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>

</head>
<body>
<main class="container">
<div class="row">
    <div class="col-md-12 head d-flex flex-row justify-content-between pt-5">      
    <h1>Engadir novo usuario</h1>
        <!-- enlace para agregar un novo usuario -->
        <div class="align-baseline">
        <a href="index.php" class="btn btn-success fw-bold"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
</svg> Volver</a>
        </div>
    </div>
</div>
<div class="row">       
    <!-- Status message -->
    <?php if(!empty($statusMsg)){ ?>
        <div class="alert alert-<?php echo $status; ?>"><?php echo $statusMsg; ?></div>
    <?php } ?>
    
    <div class="col-md-12 m-auto">
        <form method="post" action="action.php" class="form p-2">
            <div class="form-group">
                <label for="name" class="mt-2 fw-bold">Nome</label>
                <input type="text" class="form-control" name="name" value="<?php echo !empty($postData['name'])?$postData['name']:''; ?>" required="">
            </div>
            <div class="form-group">
                <label for="email" class="mt-2 fw-bold">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo !empty($postData['email'])?$postData['email']:''; ?>" required="">
            </div>
            <div class="form-group">
                <label for="phone" class="mt-2 fw-bold">Teléfono</label>
                <input type="text" class="form-control" name="phone" value="<?php echo !empty($postData['phone'])?$postData['phone']:''; ?>" required="">
            </div>
            <input type="hidden" name="action_type" value="add"/>
            <!-- input type="submit" class="form-control btn-primary" name="submit" value="Engadir usuario"/ -->
            <div class="text-end"><button type="submit" class="btn btn-primary mt-2 fw-bold">Engadir usuario</button></div>
        </form>
    </div>
</div>

</main>
    
</body>
</html>