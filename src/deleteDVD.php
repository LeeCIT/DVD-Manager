


<?php
    include "include.commonFunctions.php";
    
    $showForm     = false;
    $dvdID        = getDvdID();
    $hasID        = isset( $dvdID );
    $formValues   = [];
    $formFeedback = [];
    $message      = "";
    
    
    
    if ( ! $hasID) {
        $message  = "Missing DVD ID!";
        $showForm = false;
    }
    else {
        include 'include.databaseConnection.php';
        
        $sqlString   = "SELECT * FROM titles WHERE ID = '" . stripslashes($dvdID) . "'";
        $queryResult = mysqli_query( $dbConnection, $sqlString );
        checkQueryResult( $dbConnection, $queryResult );
        checkQuerySize( $queryResult, "No DVDs with that ID exist." );
        $formValues = fetchDvdInfoAndTranslate( $queryResult );
        
        if ( isset($_POST['submit']) ) { // If the submit button was pressed, go through with the delete
            $stmt = $dbConnection->prepare(
                "DELETE FROM titles
                 WHERE ID = ?"
            );
                
            if ( ! $stmt ) {
                echo "SQL Error: " . mysqli_error( $dbConnection );
                exit();
            }
            
            $stmt->bind_param( 's', $dvdID );
            
            if ( $stmt->execute() ) {
                $message = "<p>DVD deleted.</p>";
                $stmt->close();
            } else {
                $message = "SQL error: " . mysqli_error( $dbConnection );
            }
        }
        else {
            $showForm = true;
        }
    }
    
    
    
    $pageTitle = "Confirm Delete";
    include "include.commonHeader.html.php";
    
    if ($showForm) {
        $actionTarget         = "deleteDVD.php";
        $readPostValues       = false;
        $isFormUpdateOrCreate = false;
        $isFormDelete         = true;
        include "include.commonFormDVD.html.php";
    } else {
        echo $message;
    }
    
    include "include.commonFooter.html.php";
?>


























