
<?php
	
	function getDisplayDate () {
		$displayDate = getDate();
		$display     = $displayDate["weekday"]  . " " .
                       $displayDate["wday"]     . " " .
                       $displayDate["month"]    . " " .
                       $displayDate["year"]     . " " .
                       $displayDate["hours"]    . ":" .
                       $displayDate["minutes"]  . ":" .
                       $displayDate["seconds"];
		return $display;
	}
    
    
    
    function oneMonthFromNow() {
        return time() + 60 * 60 * 24 * 30;
    }
    
    
    
    function getCookieVisits() {
        if (isset($_COOKIE['visits']))
		     return $_COOKIE['visits'];
        else return 0;
    }
    
    
    
    function cookieVisitsUpdate() {
        $count = getCookieVisits();
        $count++;
        setCookie( "visits", $count, oneMonthFromNow() ); // Cookie will expire in one month
    }
    
    
    
    function cookieLastVisitUpdate() {
		$display = getDisplayDate();
		setCookie( "lastVisit", $display, oneMonthFromNow() );
	}
    
    
    
	function getCookieLastVisit() {
        if (isset($_COOKIE['lastVisit']))
             return $_COOKIE['lastVisit'];
        else return getDisplayDate();
    }
    
    
    
    function echoCookieVisitInfo() {
        echo "<p>Total visits: " . getCookieVisits()    . "<br>" .
                "Last visit:   " . getCookieLastVisit() . "</p>";
    }
    
?>