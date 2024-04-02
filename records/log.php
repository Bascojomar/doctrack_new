<?php
session_start();

$office = $_SESSION['Office'];

if ($office == 'SITE ADMIN' ){
  header('location: ../admin/admin');
}
elseif($office == 'VPAA'){
  header('location: ../vpaa/vpaa');
}
elseif($office == 'VPAA1'){
  header('location: ../vpaa/dashboard');
}
elseif($office == 'VPAA2'){
  header('location: ../vpaa/dashboard');
}
elseif($office == 'VPABM'){
  header('location: ../vpaa/vpaa');
}
elseif($office == 'VPABM1'){
  header('location: ../vpabm/dashboard');
}
elseif($office == 'VPABM2'){
  header('location: ../vpabm/dashboard');
}
elseif($office == 'VPRET'){
  header('location: ../vpaa/vpaa');
}
elseif($office == 'VPRET1'){
  header('location: ../vpret/dashboard');
}
elseif($office == 'VPRET2'){
  header('location: ../vpret/dashboard');
}
elseif($office == 'PRESIDENT'){
  header('location: ../vpaa/vpaa');
}
elseif($office == 'PRESIDENT1'){
  header('location: ../president/dashboard');
}
elseif($office == 'PRESIDENT2'){
  header('location: ../president/dashboard');
}
elseif($office == 'PROCUREMENT'){
  header('location: ../produrement/dashboard');
}
?>