<?
    require('config/config.php');
    require('config/db.php');

    $query = 'SELECT * FROM posts ORDER BY created_at DESC';
    $result = mysqli_query($conn, $query);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    
?>

<? include('inc/header.php'); ?>
    <h1>Posts</h1>
    <? foreach($posts as $post):?>
    <div class="jumbotron">
        <h4>
            <? echo $post['title'];?>
        </h4>
        <small>Created on <? echo $post['created_at'];?> by <? echo $post['author'];?></small>
        <p><? echo $post['body']?></p>
        <a class="btn btn-dark btn-sm" href="<? echo ROOT_URL;?>post.php?id=<? echo $post['id']?>">Read More</a>
    </div>
    <? endforeach;?>
<? include('inc/footer.php'); ?>