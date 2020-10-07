<?php
    session_start();

   $book  = (isset($_SESSION['bookmarks'])) ? $_SESSION['bookmarks']:array();

    if(isset($_POST['submit'])){
        if(!empty($_POST["bookmark"]) && !empty($_POST["url"])){
            array_push($book, [$_POST['bookmark'] ,$_POST['url']]);
            $_SESSION['bookmarks'] = $book;
        }
    
       
    }

    if(isset($_POST['x'])){
        array_splice($_SESSION['bookmarks'], $_POST['id'], 1);
    }

    if (isset($_POST['clear'])){
        $_SESSION['bookmarks'] = [];
    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    form{
        margin-top:10%;
    }

    body{
        background-color:skyblue;
    }

    .x{
        color:red;
        margin-top:-11.5%;
        float:right;
        margin-right:40%;
    }
    </style>
</head>
<body>
<center>
    <form action="bookmark.php" method= "POST">
        <label for="bookmark">Bookmark</label>
        <input type="text" id="bookmark" name= "bookmark">
        <label for="url">URL</label>
        <input type="text" id="url" name="url">
        <button type="submit" name ="submit">Add Bookmark</button>
        <input name="clear" type="submit" value="Clear">
    </form>

    <?php if(isset($_SESSION['bookmarks'])):?>
        <?php for($id= 0; $id < count($_SESSION['bookmarks']); $id++):?>
            <a href= '<?php echo $_SESSION['bookmarks'][$id][1];?>' target = "_blank">
             <?php echo 
             "<p style = 'color:pink; margin-top:50px;'</p>".
             $_SESSION['bookmarks'][$id][0];?> </a>
            <form action="bookmark.php" method="POST">
                <input type="hidden" name ="id" value="<?php echo $id;?>">
                <input class="x" name="x" type="submit" value="x">
            </form> 
        <?php endfor?>
    <?php endif?>
</body>
<center>
</html>
