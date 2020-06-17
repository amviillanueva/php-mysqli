<?
    require('config/config.php');
    require('config/db.php'); 

    if(isset($_POST['submit'])) {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        
        $query = "UPDATE posts SET title='$title', author='$author', body='$body' WHERE id='$id'";
        
        if(mysqli_query($conn, $query)) {
            header('Location: '.ROOT_URL);
        } else {
            echo "ERROR: ".mysqli_error($conn);
        }
    }

    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $post = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
    
?>

<? include('inc/header.php'); ?>

<br>
<h1>Edit Post</h1>
<br><br>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
    <input type="hidden" name="id" value="<? echo $id?>">
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <input name="title" type="text" class="form-control" placeholder="Title" value="<? echo $post['title'];?>" required>
        </div>
        <div class="col-md-4 mb-3">
            <input name="author" type="text" class="form-control" placeholder="Author" value="<? echo $post['author'];?>" required>
        </div>
    </div>
    <br>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" rows="8" class="form-control" required><? echo $post['body']?></textarea>
    </div>
    <br>
    <div class="text-center">
        <input name="submit" type="submit" value="Submit" class="btn btn btn-success col-md-2">
    </div>
</form>

<? include('inc/footer.php'); ?>