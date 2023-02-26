<?php 
class Book{
    public function addBook($conn, $code, $title, $author, $releaseYear, $total, $available){
        $sql = "INSERT INTO books(code, title, author, releaseYear, total, available)
                VALUES($code, '$title', '$author', $releaseYear, $total, $available)";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo ("<script>alert('The book is added');</script>");
            return true;
        }else{
            echo ("<script>alert('Failed to add book');</script>");
            return false;
        }
    }
    public function deleteBook($conn, $id){
        $sql = "DELETE FROM books WHERE ID = $id";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo ("<script>alert('The book is deleted');</script>");
            return true;
        }else{
            echo ("<script>alert('Failed to delete the book');</script>");
            return false;
        }
    }
    public function updateBook($conn, $id, $code, $title, $author, $releaseYear, $total, $available){
        $sql = "UPDATE books 
                SET code = $code, title = '$title', author = '$author', releaseYear = $releaseYear, total = $total, available = $available
                WHERE ID = $id";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo ("<script>alert('The book is updated');</script>");
            return true;
        }else{
            echo ("<script>alert('Failed to update the book');</script>");
            return false;
        }
    }
}
?>