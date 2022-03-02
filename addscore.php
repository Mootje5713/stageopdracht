<?php
    include "connection.php";   
    
    $id = intval($_GET['id']);
    $query = "SELECT * FROM `domain` WHERE id=$id";
    $result=$conn->query($query);
    if ( $result === FALSE) {
        echo "error" . $domain . "<br />" . $conn->error;
    } else {
        if ($result->num_rows>0) {
            while($row=$result->fetch_assoc())
            {
                $domains[] = $row;
            }
        }
    }

    $key = "AIzaSyDMDZIKFkV8A1K7aDjjuZ_K9fWUnIL2L_Q"; 
    $url = $domains[0]['domainname'];
    $ch = curl_init("https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=$url&key=$key&strategy=mobile");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($ch);
    $json = json_decode($curl_response); 
    
    $h = fopen('log.txt', 'w');

    fwrite($h, $curl_response);

    fclose($h);

    $performance_score = $json->lighthouseResult->categories->performance->score * 100;

    if (isset($performance_score)) 
    {
        $speed = $json->lighthouseResult->audits->metrics->details->items[0]->speedIndex;
        $fcp = $json->lighthouseResult->audits->metrics->details->items[0]->firstContentfulPaint;
        $tti = $json->lighthouseResult->audits->metrics->details->items[0]->interactive;
    //toevoegen van alle waarden uit web.dev/measure (4 scores tussen 0 en 100 en 6 of 8 'timings' in seconde)


    //die(var_dump($json->lighthouseResult->audits));

    if(isset($performance_score)) {
        $query = "INSERT INTO `score` (score, speed, fcp, tti, domain_id)
        VALUES ('$performance_score', '$speed', '$fcp', '$tti', '$id')";
        if ($conn->query($query) === FALSE) {
            echo "error" . $query . "<br />" . $conn->error;
        } else {
            header("Location: domain.php?id=".$_GET['id']);
        }
    }

} else {
    echo "<div> <span style='color:red;text-align:center;'>" . 
    $json->error->message . "</span> </div>";
    //var_dump($json);
}
    $conn->close();

include "header.php";
?>



<?php include "footer.php"; ?>