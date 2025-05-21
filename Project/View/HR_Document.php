
      <?php
    session_start();
    if (isset($_COOKIE['status'])){
      //$role = $_COOKIE['emp'];
      if (isset($_COOKIE['emp'])){
        header('Location: Employee_dashboard.php');}
        if (isset($_COOKIE['mng'])){
        header('Location: manager_dashboard.php');}
        if (isset($_COOKIE['emp_doc'])){
        header('Location: emp_document.php');}
        if (isset($_COOKIE['emp_emp'])){
        header('Location: Emp_employee.php');}
        if (isset($_COOKIE['emp_leave'])){
        header('Location: employee_leave.php');}
        // if (isset($_COOKIE['hr_perfomance'])){
        // header('Location: HR_perfomance.php');}
        if (isset($_COOKIE['mng_leave'])){
        header('Location: Leave_manager.php');}
        if (isset($_COOKIE['mng_doc'])){
        header('Location: mng_document');}
        if (isset($_COOKIE['mng_emp'])){
        header('Location: mng_employee.php');}
       if (isset($_COOKIE['hr'])){
       
        //header('Location: Employee_dashboard.php');
       
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Document Storage</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: rgb(249, 249, 249);
      color: #1c1f1c;
    }

    .container {
      display: flex;
      width: 100%;
      min-height: 100vh;
    }

    .main {
      flex: 1;
      padding: 30px;
      margin-left: 250px;
      color: #1c1f1c; 
    }

    h1 {
      color: #1c1f1c;
      margin-bottom: 20px;
    }

    .upload-section,
    .vault-section,
    .signature-section,
    .retention-section {
      background-color: rgba(202, 206, 161, 0.432);
      padding: 20px;
      border-radius: 0px;
      margin-bottom: 20px;
      color: #1c1f1c;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #1c1f1c;
    }

    input[type="file"],
    select {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      color: #1c1f1c;
    }

    button {
      padding: 10px 15px;
      background-color: #85876a;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    

    form {
      all: unset;
      display: contents;
    }

    .retention-policy {
      background: white;
      padding: 15px;
      border-radius: 5px;
      font-size: 14px;
    }
  </style>
</head>
<body>
  


  <div class="container">
  <?php include 'sidebar.html'; ?>
  <div class="main">

    <h3><i>Important Documents📁</i></h3>

    
    <div class="upload-section">
      <h3>Upload Document</h3>
      <label>Select Document:</label>
      <input type="file" id="docInput">

      <label>Set Permission:</label>
      <select id="permissionSelect" style="height: 30px; width: 100px;  background-color: rgba(121, 223, 53, 0.151); color: rgb(24, 23, 23); background: transparent;">
        <option value="manager">Manager</option>
        <option value="all">All Employees</option>
      </select>

      <button onclick="uploadDoc()">Upload</button>
    </div>

    
    <div class="vault-section">
      <h3>Stored Documents</h3>
      <ul id="vaultList">
        
      </ul>
    </div>

    
    <div class="signature-section">
      <h3>Collect Electronic Signature</h3>
      <label><input type="checkbox" id="signatureCheck"> I acknowledge and sign this document.</label>
    </div>

    
    <div class="retention-section">
      <h3>Automated Retention Policy</h3>
      <div class="retention-policy">
        Documents will be retained for a maximum of 3 years unless flagged for extended access by HR. Expired documents are automatically flagged for deletion.
      </div>
    </div>
  </div>
  </div>

  <script>
    function uploadDoc() {
      var fileInput = document.getElementById('docInput');
      var permission = document.getElementById('permissionSelect').value;
      var vaultList = document.getElementById('vaultList');

      if (fileInput.files.length === 0) {
        alert("Please select a document to upload.");
        return;
      }

      var fileName = fileInput.files[0].name;
      var listItem = document.createElement('li');
      listItem.textContent = fileName + " [Permission: " + permission + "] - v1.0";

      vaultList.appendChild(listItem);

      fileInput.value = "";
    }
  </script>
  
</body>
</html>
<?php
      }
  }else{
        header('location: UserAuth.html');
    }

?>