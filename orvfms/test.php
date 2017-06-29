<?php
/*************************************************************************
*  Copyright (C) 2015 by Fernando M. Silva
*                                                                       *
*  This program is free software; you can redistribute it and/or modify *
*  it under the terms of the GNU General Public License as published by *
*  the Free Software Foundation; either version 3 of the License, or    *
*  (at your option) any later version.                                  *
*                                                                       *
*  This program is distributed in the hope that it will be useful,      *
*  but WITHOUT ANY WARRANTY; without even the implied warranty of       *
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        *
*  GNU General Public License for more details.                         *
*                                                                       *
*  You should have received a copy of the GNU General Public License    *
*  along with this program.  If not, see <http://www.gnu.org/licenses/>.*
*************************************************************************/

/*

  This program was developed independently and it is not
  supported or endorsed in any way by Orvibo (C).  

  General test program of intended to test all functions
  in orvfms.php and util.php

  It loops through all s20 plugs and switch them off and on.

  At the end it tests the count down timer in one of the devices,
  counting twice for 10 seconds, and toggling the result at the
  end.

  PLEASE TAKE INTO ACCOUNT POSSIBLE SAFETY ISSUES  of switching on/off! 
  Uplug any device or appliance that nay be affected by this test cycle!
  
  This is intended to be run from the command line for test purposes. Use 

  prompt>  php-cgi test.php

*/
error_reporting(E_ALL & ~E_NOTICE); ini_set('display_errors', '1');
include("orvfms.php");

$s20Table = initS20Data(); 
if(count($s20Table) == 0){
    echo " No sockets found\n\n";
    echo " Please check if all sockets are on-line and assure that they\n";
    echo " they are not locked (check WiWo app -> select socket -> more -> Advanced\n\n";
    echo " This code does not support locked or password protected devices\n\n\n";
    exit(0);
}

$s20Table = updateAllStatus($s20Table);   // Update all status (not required, just for test, 
                                              //since immediately after init they   
                                              // are already uptodate)
// Print the full array

foreach($s20Table as $id => $socket) {
    // Convert name to utf-8 to allow json encoding
    $s20Table[$id]['name'] = mb_convert_encoding($s20Table[$id]['name'], 'UTF-8');
}
die(json_encode($s20Table));
?>
