<?
    require('config/config.php');
    require('config/db.php');

    if(isset($_POST['submit'])) {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        
        $query = "INSERT INTO posts(title, author, body) VALUES('$title', '$author', '$body')";
        
        if(mysqli_query($conn, $query)) {
            header('Location: '.ROOT_URL);
        } else {
            echo "ERROR: ".mysqli_error($conn);
        }
    }
?>

<? include('inc/header.php'); ?>

<br>
<h1>Add Post</h1>
<br><br>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <input name="title" type="text" class="form-control" placeholder="Title" required>
        </div>
        <div class="col-md-4 mb-3">
            <input name="author" type="text" class="form-control" placeholder="Author" required>
        </div>
    </div>
    <br>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea name="body" rows="8" class="form-control" required></textarea>
    </div>
    <br>
    <div class="text-center">
        <input name="submit" type="submit" value="Submit" class="btn btn btn-success col-md-2">
    </div>
</form>

<? include('inc/footer.php'); ?>