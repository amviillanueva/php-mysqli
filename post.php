<?
    require('config/config.php');
    require('config/db.php');

    if(isset($_POST['delete'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);

        $query = "DELETE FROM posts WHERE id='$id'";
        
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
    <a class="btn btn-primary btn-sm" href="<? echo ROOT_URL?>">Back</a>
    <hr>
    <h1><? echo $post['title'];?></h1>
    <small>Created on <? echo $post['created_at'];?> by <? echo $post['author'];?></small>
    <p>  <? echo $post['body']?> </p>
    <hr>
    <a class="btn btn-primary btn-sm" href="<? echo ROOT_URL?>edit-post.php?id=<? echo $id?>">Edit</a>
    <form action="<? $_SERVER['PHP_SELF']?>" method="post" style="display: inline-block;">
        <input type="hidden" name="id" value="<? echo $id?>">
        <input name="delete" class="btn btn-danger btn-sm" type="submit" value="Delete">
    </form>
    
<? include('inc/footer.php'); ?>