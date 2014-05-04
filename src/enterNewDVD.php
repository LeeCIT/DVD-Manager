


<?php
    include "include.commonFunctions.php";

    $showForm     = true;
    $formFeedback = [];
    
    if (isSubmitting()) {
        $formFeedback  = genFormFeedback();
        $missingFields = (count($formFeedback) > 0);
        $showForm      = $missingFields;
        
        if ( ! $showForm) {
            include "include.databaseConnection.php";
            
            $stmt = $dbConnection -> prepare(
                "INSERT INTO titles ( cert, filmtitle, releaseDate, filmDuration, director, description )
                VALUES ( ?, ?, ?, ?, ?, ? )"
            );
            
            if ( ! $stmt) {
                echo "SQL error: " . mysqli_error($dbConnection);
                exit();
            }
            
            // Bind the parameters to the statement.
            $stmt->bind_param( 'ssssss',
                $_POST['title'],
                $_POST['cert'],
                $_POST['releaseDate'],
                $_POST['filmDuration'],
                $_POST['director'],
                $_POST['description']
            );
            
            if ($stmt->execute()) {
                $showForm = false;
                $message = "<p>Added new DVD.</p>";
                $stmt->close();
            } else {
                echo "Execution error" . mysqli_error($dbConnection);
                exit();
            }
        }
    }
    
    
    
    $pageTitle = "Add DVD";
    include "include.commonHeader.html.php";
    
    if ($showForm) {    
        $actionTarget         = "enterNewDVD.php";
        $readPostValues       = true;
        $formValues           = [];
        $isFormUpdateOrCreate = true;
        $isFormDelete         = false;
        include "include.commonFormDVD.html.php";
    } else {
        echo $message;
    }
    
    include "include.commonFooter.html.php";
?>