


<?php
    function getDvdID() {
        $id = "dvdID";
    
        if (isset($_POST[$id])) {
            return $_POST[$id];
        }
        else if (isset($_GET[$id])) {
            return $_GET[$id];
        }
        else {
            return null;
        }
    }
    
    
    
    function fetchDvdInfoAndTranslate( $queryResult ) {
        $array           = mysqli_fetch_assoc( $queryResult );
        $array["dvdID"]  = $array["ID"];
        $array["title"]  = $array["filmtitle"];
        
        return $array;
    }
    
    
    
    function checkQueryResult( $dbConnection, $queryResult ) {
        if ( ! $queryResult) {
            echo 'SQL error: ' . mysqli_error( $dbConnection );
            include 'include.error.html.php';
            exit();
        }
    }
        
    function checkQuerySize( $queryResult, $message ) {
        if ( ! mysqli_num_rows($queryResult)) {
            echo $message;
            exit();
        }
    }
    
    
    
    function trimmedLen( $str ) {
        return strlen( trim($str) );
    }
    
    
    
    function getFieldNames() {
        return [ 'cert', 'title', 'releaseDate', 'filmDuration', 'director', 'description' ];
    }
    
    
    
    function isSubmitting() {
        return isset( $_POST['submit'] );
    }
    
    
    
    // Generate mappings for field feedback.
    function genFormFeedback() {
        $formFeedback = [];
    
        foreach (getFieldNames() as $field)
            if ( (! isset($_POST[$field])) || trimmedLen($_POST[$field]) == 0)
                $formFeedback[$field] = 'Required';
                
        return $formFeedback;
    }
    
    
    
    function getPostString( $str ) {
        $set = isset( $_POST[$str] );
        
        if ($set)
             return $_POST[$str];
        else return "";
    }
    
?>