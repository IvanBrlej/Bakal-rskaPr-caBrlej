<?php
include('includes/header.php');

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
    <title>Export</title>
</head>
<body>
<div class="container" style="margin-top: 60px" align="center">
    <form id="exportSubject" method="post" action="exportPDF_handler.php" name="exportSubject">
        <div class="container">
            <input type="hidden" id="subject" name="subject" value="<?php echo $subject; ?>">
        </div>
        <div class="container">
            <div class="col-sm-10">
                <button type="submit" class="button_send" id="submitSubject" name="submitSubject">PDF</button>
            </div>
        </div>
    </form>
</div>

<div class="container">
        <div class="container">
            <button type='submit' class="button_send" id="CSV" value='CSV' name="CSV">CSV</button>
        <table>
            <tr>
                <th>Answer</th>
                <th>Time of submission</th>
            </tr>
            <?php
            $query = "SELECT * FROM answers WHERE subject = '$subject'  ORDER BY id asc";
            $result = mysqli_query($con,$query);
            $record_arr = array();
            while($row = mysqli_fetch_array($result)){
                $answer = $row['answers'];
                $odpovede = json_decode($answer,true);
                $time_of_submission = $row['time_of_submission'];
                $record_arr[] = array($answer);
                ?>
                <tr>
                    <td>
                        <?php foreach($odpovede as $a) {
                            foreach($a as $key => $value){
                                echo $key . ": " . $value . " , ";
                            }
                        }

                        ?>
                        </td>
                    <td><?php echo $time_of_submission; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
        $serialize_record_arr = serialize($record_arr);
        ?>
        </div>
        <textarea name='export_data' style='display: none;'><?php echo $serialize_record_arr; ?></textarea>
</div>
</body>
<script>function htmlToCSV(html, filename) {
        var data = [];
        var rows = document.querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }

            data.push(row.join(","));
        }

        downloadCSVFile(data.join("\n"), filename);
    }
</script>
<script>function downloadCSVFile(csv, filename) {
        var csv_file, download_link;

        csv_file = new Blob([csv], {type: "text/csv"});

        download_link = document.createElement("a");

        download_link.download = filename;

        download_link.href = window.URL.createObjectURL(csv_file);

        download_link.style.display = "none";

        document.body.appendChild(download_link);

        download_link.click();
    }
</script>
<script>document.getElementById("CSV").addEventListener("click", function () {
        var html = document.querySelector("table").outerHTML;
        htmlToCSV(html, "data.csv");
    });
</script>
</html>
