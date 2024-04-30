<?
if ($vpaa == 'signed') {
  if ($vpabm == 'signed') {
      if ($vpret == 'signed') {
          // Your code goes here if all conditions are met
      } else {
          // Redirect or display a message indicating $vpret is not signed
          header('Location: your_page.php');
          exit(); // Make sure to exit after redirection
      }
  } else {
      // Redirect or display a message indicating $vpabm is not signed
      header('Location: your_page.php');
      exit(); // Make sure to exit after redirection
  }
} else {
  // Redirect or display a message indicating $vpaa is not signed
  header('Location: your_page.php');
  exit(); // Make sure to exit after redi
}
?>