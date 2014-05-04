


<?php
    include 'include.databaseDetails.php';
    
    

    // Connect to the SQL database
    $dbConnection = mysqli_connect(
        $dbHost,
        $dbLogin,
        $dbPass,
        $dbName
    );
    
    unset( $dbHost  );
    unset( $dbLogin );
    unset( $dbPass  );
    
    
    
    
    if ( ! $dbConnection) {
        echo "Unable to connect to database";
        exit();
    }
    
    
    
    // Select database and check that it succeeded.
    if ( ! mysqli_select_db( $dbConnection, $dbName )) {
        echo "Unable to select $dbName database.";
        exit();
    }
    
    unset( $dbName );
?>
