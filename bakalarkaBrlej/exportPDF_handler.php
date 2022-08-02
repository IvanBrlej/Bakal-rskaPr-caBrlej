<?php
require 'includes/connection.php';

if(isset($_POST['subject'])){
    $subject = $_POST['subject'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/src/css/style.css">
    <link rel="stylesheet" href="export.css" type="text/css" media="print">
    <title>Export</title>
</head>
<body>
<button onclick="window.print();" class="button_send" id="print-btn">Export</button>
<div class="container">
        <div class="container">
            <table>
                <tr>
                    <th>Answer</th>
                </tr>
                <?php
                $query = "SELECT * FROM answers WHERE subject = '$subject'  ORDER BY id asc";
                $result = mysqli_query($con,$query);
                $record_arr = array();
                while($row = mysqli_fetch_array($result)){
                    $answer = $row['answers'];
                    $record_arr[] = array($answer);
                    $odpovede = json_decode($answer,true);
                    $time_of_submission = $row['time_of_submission'];
                    ?>
                    <tr>
                        <td><?php foreach($odpovede as $a) {
                                foreach($a as $key => $value){
                                    echo $key . ": " . $value . "<br>";
                                }
                            }
                            ?></td>
                        <td><?php echo $time_of_submission; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
</div>
</body>
</html>
