<?php
// Set role cookie to "hr"
setcookie("user_role", "hr", time() + 3600, "/"); // expires in 1 hour
//echo "Role cookie set to HR. <a href='hr_dashboard.php'>Go to HR Dashboard</a>";
?>
