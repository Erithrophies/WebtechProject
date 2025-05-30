<?php
session_start();

include('../Controller/trainingEmployeeDoc.php');

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

    table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

  </style>
</head>
<body>

<div class="container">
  <?php include 'mng_sidebar.php'; ?>
  <div class="main">

    <h3><i>Trainings:  -</i></h3>
        <?php if (!empty($assignedTrainings)): ?>
    <table>
        <thead>
            <tr>
                <th>Training Title</th>
                <th>Assigned By</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assignedTrainings as $training): ?>
                <tr>
                    <td><?= $training['training_name'] ?></td>
                    <td><?= $training['manager_name'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No training assigned yet.</p>
<?php endif; ?>
  </div>
</div>


<script>
 
  
</script>

</body>
</html>

<?php
} else {
 
  header("Location: UserAuth.html");
}
?>