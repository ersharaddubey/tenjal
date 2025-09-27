<?php include './include/header.php'; 
include './include/db_connect.php'; // Fixed path
?>
<body>
    <!-- About End -->
 <div class="container my-5">
  <div class="card-columns">
    <?php
    $stmt = $pdo->query("SELECT * FROM blogs");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '
    <div class="card hero-header">
      <a href="Blog-details.php?id=' . $row['id'] . '">
        <img class="card-img-top" src="' . $row['image'] . '" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">' . $row['title'] . '</h5>
          <p class="card-text">' . substr($row['content'], 0, 200) . '...</p> <!-- Truncated for preview -->
          <p class="card-text"><small class="text-muted"><i class="fas fa-eye"></i>' . $row['views'] . '<i class="far fa-user"></i>' . $row['author'] . '<i class="fas fa-calendar-alt"></i>' . $row['created_at'] . '</small></p>
        </div>
      </a>
    </div>';
    }
    ?>
  </div>
</div>
    <!-- Blog End-->
  <?php include './include/footer.php'; ?>
</body>
</html>