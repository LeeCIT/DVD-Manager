


<?php
    include "include.commonFunctions.php";
    
    $showForm     = true;
    $dvd          = [];
    $dvdID        = getDvdID();
    $hasID        = isset( $dvdID );
    $formFeedback = [];
    $formValues   = [];
    $message      = "";
    $submitting   = isSubmitting();
    
    
    
    if ( ! $hasID) {
        $message  = "Missing DVD ID!";
        $showForm = false;
    } 
    else {
        include 'include.databaseConnection.php';
       
        $sqlString   = "SELECT * FROM titles WHERE ID = '"  . stripslashes($dvdID) . "';";
        $queryResult = mysqli_query( $dbConnection, $sqlString );
        checkQueryResult( $dbConnection, $queryResult );
        checkQuerySize( $queryResult, "No DVDs with that ID exist." );
        
        $formValues = fetchDvdInfoAndTranslate( $queryResult );
        
        if ( $submitting ) { // If the submit button was pressed validate inputs
            $formFeedback  = genFormFeedback();
            $missingFields = (count($formFeedback) > 0);
            $showForm      = $missingFields;
            
            if ( ! $showForm) { // Update the database
                $stmt = $dbConnection->prepare(
                    "UPDATE titles SET 
                    filmtitle    = ?,
                    cert         = ?,
                    releaseDate  = ?,
                    filmDuration = ?,
                    director     = ?,
                    description  = ? 
                    WHERE ID = ?;"															
                );
                
                if ( ! $stmt) {
                    echo "SQL error: " . mysqli_error( $dbConnection );
                    exit();
                }
                
                $paramTitle = getPostString( 'title'        ); // It may seem redundant, but bind_param has the ugly
                $paramCert  = getPostString( 'cert'         ); // quirk of requiring references to variables.
                $paramRel   = getPostString( 'releaseDate'  ); // ~PHP sux~
                $paramDur   = getPostString( 'filmDuration' );
                $paramDir   = getPostString( 'director'     );
                $paramDesc  = getPostString( 'description'  );
                $paramID    = getPostString( 'dvdID'        );
                
                $stmt->bind_param( 'sssssss',
                    $paramTitle,
                    $paramCert,
                    $paramRel,
                    $paramDur,
                    $paramDir,
                    $paramDesc,
                    $paramID   
                );
                
                if ( $stmt->execute() ) {
                    $message = "<p>DVD info updated.</p>";
                    $stmt->close();
                } else {
                    echo "SQL error: " . mysqli_error( $dbConnection );
                    exit();
                }               
            }
        }       
    }       
    
    
    
    $pageTitle = "Edit DVD";
    include "include.commonHeader.html.php";
    
    if ($showForm) {
        $actionTarget         = "updateDVD.php";
        $readPostValues       = $submitting;
        $isFormUpdateOrCreate = true;
        $isFormDelete         = false;
        include "include.commonFormDVD.html.php";
    } else {
        echo $message;
    }
    
    include "include.commonFooter.html.php";
?>