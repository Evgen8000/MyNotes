<?php
ob_start();
include_once ('Controller.php');
include_once ('html/header.html');
include_once ('html/noteEdit.html');

$controller = new NoteController();
$FLAG = $_GET['editFlag'];
if($_GET['editFlag']) {
    $note = $controller->GetNoteByID($_GET["id"]);
    $noteName = $note->NoteName;
    $noteText = $note->NoteText;
    echo "
<script>
document.getElementById(\"name\").value = '" . $noteName . "';
document.getElementById(\"notetext\").value = '" . $noteText . "';
</script>";
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_GET["editFlag"] == 1){
        $controller->Edit($_GET["id"],$_POST["name"],$_POST["notetext"]);
        print_r($_POST["name"]);
    } else {

        $controller->Add($_SESSION["ID"],$_POST["name"],$_POST["notetext"]);
    }
    header("Location: /notes.php", true);
}
ob_flush();