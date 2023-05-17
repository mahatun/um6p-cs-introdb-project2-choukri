<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">

   <div class="">
    
    <div class="table-responsive">
      <table class="table table-bordered">
       <thead>
        <th>Outbound delivery</th>
         <th>Avis de chargement status</th>
         <th>Contract ID</th>
         <th>Contract Status</th>
         <th>Invoice</th>
         <th>Invoiced amount</th>
         <th>Payment deadline</th>
         <th>Payment status</th>
         
    </thead>
    <tbody>
    <?php
    //Create new user (just for testing , the user will be in the session array)
    require '../dbconfig.php';
    require '../models/User.php';
    require '../models/PhosphateQueries.php';
   $userModel = new User($conn);
   $phosphateUser = new PhosphateQueries($conn);
   $tableName = 'temporary_full_table';
  // print_r();
    $fetchData = $userModel->selectADV();
    if(is_array($fetchData)){      
      foreach($fetchData as $data){
    ?>
      <tr>
      <td><?php echo $data['od']??''; ?></td>
      <td><?php echo $data['ac_status']??''; ?></td>
      <td><?php echo $data['contract_id']??''; ?></td>
      <td><?php echo $data['contract_status']??''; ?></td>
      <td><?php echo $data['invoice']??''; ?></td>
      <td><?php echo $phosphateUser->getInvoicedAmount($data['net_quantity'],$data['total_volume'])??''; ?></td>
      <td><?php echo $phosphateUser->getEta($data['payment_terms_days'],$data['bldate']) ??''; ?></td>
      <td><?php echo $data['payment_status']??''; ?></td>
           
     </tr>
     <?php
      }}else{ ?>
      <tr>
        <td colspan="17">
    <?php echo $fetchData; ?>
  </td>
    <tr>
    <?php
    }?>
    </tbody>
     </table>
   </div>
 
</div>

</div>
</body>
</html>