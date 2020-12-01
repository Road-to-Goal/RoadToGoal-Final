<?php



if(isset($_POST['title'] ) &&  isset($_POST['category'] ) && isset($_POST['due_date'] )){
    require '../db_conn.php';

   $title = $_POST['title'];
    $category = $_POST['category'];
    $due_date = date('Y-m-d H:i', strtotime($_POST['due_date']));
    
   /* $title = (!empty($_POST['title']) ? $_POST['title'] : '');
    $category = (!empty($_POST['category']) ? $_POST['category'] : '');*/
    

    if(empty($title)){
        header("Location: ../index.php?mess=error");
    }else {
        $sql = 'INSERT INTO todos (title,category,due_date) VALUES (:title, :category,:due_date)';
        $query = $conn->prepare($sql);
        $query->execute(array(':title' => $title, ':category' => $category, ':due_date' => $due_date));
       /* $stmt = $conn->prepare("INSERT INTO todos('title','category') VALUES (?,?)");
        $res = $stmt->execute([$title,$category]);
        */
        if($query){
            header("Location: ../index.php?mess=success"); 
        }else {
            header("Location: ../index.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}