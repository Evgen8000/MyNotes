<?php
include_once ('Controller.php');
include_once ('html/header.html');

$controllerNote = new NoteController();
$controllerUser = new UserController();
$var1 = $controllerNote->GetByUserIDNoFetch($_SESSION['ID']);
echo "<div class='container'><ul class=\"collapsible\" data-collapsible=\"accordion\">";
$iterator = 0;
while($var = $var1->fetch_array()):
echo "
    <li>
      <div class=\"collapsible-header ". $var["Color"] ." lighten-2\"><i class=\"material-icons\">filter_drama</i>" . $var['NoteName'] . "</div>
      <div class=\"collapsible-body white\"><p>". $var["NoteText"] ."</p>
       <div style='margin-bottom: 5px; margin-top: 5px;' class='center'>
       <a class=\"modal-trigger waves-effect waves-light btn-floating green \" href='/noteedit.php?editFlag=1&id=". $var["NoteID"] ."'><i class=\"material-icons\">edit</i></a>
      <a class=\"btn-floating red\"><i class=\"material-icons\">delete</i></a></div>";

    echo "</div></li>";
endwhile;
echo " </ul>";
echo "<a class=\"btn-floating btn-large waves-effect waves-light red\" href='/noteEdit.php?editFlag=0'><i class=\"material-icons\">add</i></a></div>";