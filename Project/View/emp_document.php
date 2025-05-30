<?php
session_start();



if (isset($_SESSION['type']) && $_SESSION['type'] === 'employee') {
  
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Employee Document Viewer</title>
  <style>
      * { box-sizing: border-box; }
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
  body {
      min-height: 100vh;
      display: flex;
      font-family: Arial, sans-serif;
      background-color: rgb(249, 249, 249);
      color: white;
      margin: 0;
      padding: 0;
      
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

    h1, h3 {
      
      margin-bottom: 20px;
    }

    .vault-section {
      background-color: rgba(202, 206, 161, 0.432);
      padding: 20px;
      border-radius: 0px;
      margin-bottom: 20px;
      
    }

    ul {
      list-style: none;
      padding: 0;
    }

    li {
      margin-bottom: 10px;
    }

    .download-btn {
      padding: 5px 10px;
      background-color: #85876a;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      margin-left: 10px;
      font-size: 14px;
    }

    .download-btn:hover {
      background-color: #6f7059;
    }
  </style>
</head>
<body>

<div class="container">
  <?php include 'Emp_sidebar.php'; ?>
  <div class="main">

    <h3><i>📂 Your Accessible Documents</i></h3>

    <div class="vault-section">
      <h3>Available Documents</h3>
      <ul id="vaultList">
        
      </ul>
    </div>

  </div>
</div>

<script>
 
  var docs = []; 

  var vaultList = document.getElementById("vaultList");

  if (docs.length === 0) {
    var emptyMessage = document.createElement("li");
    emptyMessage.textContent = "No documents available at the moment.";
    vaultList.appendChild(emptyMessage);
  } else {
    for (var i = 0; i < docs.length; i++) {
      var listItem = document.createElement("li");
      listItem.innerHTML = docs[i].name + " <a href='" + docs[i].path + "' class='download-btn' download>Download</a>";
      vaultList.appendChild(listItem);
    }
  }
</script>

</body>
</html>

<?php
} else {
 
  header("Location: UserAuth.html");
  exit();
}
?>