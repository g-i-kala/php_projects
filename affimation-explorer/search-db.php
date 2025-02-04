<?php

include 'db.php';
include 'helpers.php';

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["problem"])){
    try {
        //fetch problem from the form
        $problem = $_POST["problem"];
        
        //remove pl2small
        $problem_formatted = removePolishSmallChars($problem);

        $query = 'SELECT * FROM afirmacje WHERE problemFormat LIKE :problem';
        $problemQuery = $conn->prepare($query);
        $problemQuery->execute(['problem' => '%' . $problem_formatted . '%']);

        $problemy = $problemQuery->fetchAll(PDO::FETCH_ASSOC);

        if (count($problemy) > 0) {
            echo "<h2> Wyniki dla: $problem </h2>";
            echo "<table border =1> 
                    <tr>
                        <th>Problem</th>
                        <th>Potencjalna przyczyna</th>
                        <th>Wzorzec myślowy do wyminay</th>
                    </tr>";
            foreach($problemy as $row) {
                echo "<tr> 
                        <td>" . htmlspecialchars($row['problem']) . "</td>
                        <td>" . htmlspecialchars($row['pPrzyczyna']) . "</td>
                        <td>" . htmlspecialchars($row['nowyWzorzec']) . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nie mam dopasowań dla " . htmlspecialchars($problem) . ". Spróbój inaczej nazwać problem.</p>";
        }
        
    } catch (Exception $e) {
        echo "Error: ".$e->getMessage();  
    }
}

?>