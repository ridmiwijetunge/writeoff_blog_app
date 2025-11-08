<?php
include 'db_connect.php';
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: credentials.php"); exit; }
$uid = $_SESSION['user_id'];
$edit_mode = false;
$title = ""; $content = ""; $post_id = null;

if (isset($_GET['id'])) {
    $post_id = (int)$_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM blog_post WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii",$post_id,$uid);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 1) {
        $edit_mode = true;
        $r = $res->fetch_assoc();
        $title = $r['title'];
        $content = $r['content'];
    } else {
        echo "<script>alert('You cannot edit this post.'); window.location='my_account.php';</script>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    if ($edit_mode) {
        $up = $conn->prepare("UPDATE blog_post SET title=?, content=?, updated_at=NOW() WHERE id=? AND user_id=?");
        $up->bind_param("ssii",$title,$content,$post_id,$uid);
        $ok = $up->execute();
    } else {
        $ins = $conn->prepare("INSERT INTO blog_post (user_id, title, content, created_at) VALUES (?,?,?,NOW())");
        $ins->bind_param("iss",$uid,$title,$content);
        $ok = $ins->execute();
    }
    if ($ok) header("Location: my_account.php");
    else $msg = "Error saving post.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= $edit_mode ? 'Edit' : 'Create' ?> Blog — WriteOff</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&family=Merriweather:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="app-header"><div class="header-inner"><div class="brand"><div class="logo-circle">W</div><div><div class="site-title">WriteOff</div><div class="site-sub">Editor</div></div></div><div class="header-actions"><a href="home.php" class="btn">Home</a><a href="my_account.php" class="btn">Dashboard</a></div></div></header>

  <div class="container">
    <div class="form-card">
      <h2><?= $edit_mode ? 'Edit your post' : 'Create a new post' ?></h2>
      <?php if (!empty($msg)) echo "<div class='alert error'>".htmlspecialchars($msg)."</div>"; ?>
      <form method="post" action="">
        <label>Title</label>
        <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required>
        <label>Content</label>
        <textarea name="content" required><?= htmlspecialchars($content) ?></textarea>
        <div style="margin-top:14px; text-align:center;">
          <button class="btn-primary" type="submit"><?= $edit_mode ? 'Update Post' : 'Publish Post' ?></button>
        </div>
      </form>
    </div>
  </div>

  <footer class="app-footer"><div class="container"><small>© <?= date("Y") ?> WriteOff</small></div></footer>
</body>
</html>
