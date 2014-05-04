


<?php
    function echoTable( $queryResult ) {
        echo "<table>\n";
        echo "<tbody>\n";
        
        echoTableHeaders();
        echoTableRows( $queryResult );
        
        echo "</tbody>\n";
        echo "</table>\n";
    }
    
    
    
    function echoTableHeaders() {
        $headers = [
            "ID",           
            "Title",   
            "Cert",         
            "Release Date", 
            "Duration",
            "Director",     
            "Description"
        ];
        
        echo "<tr>\n";
        
        foreach ($headers as $header)
            echo "    <th>$header</th>\n";
            
        echo '    <th colspan="2">Actions</th>' . "\n";
        echo "</tr>\n";
    }
    
    
    
    function echoTableRows( $queryResult ) {
        $columns = [
            'ID',
            'filmtitle',
            'cert',
            'releaseDate',
            'filmDuration',
            'director',
            'description'
        ];
        
        $switch = false;
        
        while ($dvd = mysqli_fetch_assoc($queryResult)) {
            $switch = !$switch;
            
            if ($switch)
                 echo "<tr>\n";
            else echo "<tr class=\"alternator\">\n";
            
            foreach ($columns as $column)
                echo genTableData( $dvd, $column );
                
            $id = $dvd[ 'ID' ];
            echo genTableDataLink( 'updateDVD.php', $id, 'Edit'   );
            echo genTableDataLink( 'deleteDVD.php', $id, 'Delete' );
            echo "</tr>\n";
        }
    }
    
    
    
    function genTableData( $dvdArray, $param ) {
        $val = $dvdArray[ $param ];
        return "    <td>" . htmlspecialchars($val) . "</td>\n";
    }
    
    
    
    function genTableDataLink( $file, $id, $text ) {
        $link = "<a href=\"$file?dvdID=$id\">$text</a>";
        return "    <td class=\"action\">" . $link . "</td>\n";
    }
    
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////
    // Main
    /////////////////////////////////////////////////////////////////////////
    
    include "include.commonFunctions.php";
    include "include.cookie.php";
    cookieVisitsUpdate();
	cookieLastVisitUpdate();
    
    $pageTitle = "Collection"; // Used by header include
    include 'include.commonHeader.html.php';
    
    echoCookieVisitInfo();
    
    
    include 'include.databaseConnection.php';
    $sqlString   = "SELECT * FROM titles ORDER BY ID"; // No user input; no possibility of SQL injection attack
    $queryResult = mysqli_query( $dbConnection, $sqlString );
    
    checkQueryResult( $dbConnection, $queryResult );
    checkQuerySize( $queryResult, "There are no DVDs to list." );
    
    include 'include.commonFooter.html.php';
?>










