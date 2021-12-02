<?php
if(!function_exists('get_position')) {
    function get_position($val) {
        $val = (int) $val;
        if     ($val==1)  { $pos= '1st';   }
        elseif ($val==2)  { $pos= '2nd';   }
        elseif ($val==3)  { $pos= '3rd';   }
        elseif ($val==4)  { $pos= '4th';   } 
        elseif ($val==5)  { $pos= '5th';   } 
        elseif ($val==6)  { $pos= '6th';   }
        elseif ($val==7)  { $pos= '7th';   } 
        elseif ($val==8)  { $pos= '8th';   } 
        elseif ($val==9)  { $pos= '9th';   } 
        elseif ($val==10) { $pos= '10th';  } 
        elseif ($val==11) { $pos= '11th';  } 
        elseif ($val==12) { $pos= '12th';  } 
        elseif ($val==13) { $pos= '13th';  } 
        elseif ($val==14) { $pos= '14th';  } 
        elseif ($val==15) { $pos= '15th';  } 
        elseif ($val==16) { $pos= '16th';  } 
        elseif ($val==17) { $pos= '17th';  } 
        elseif ($val==18) { $pos= '18th';  } 
        elseif ($val==19) { $pos= '19th';  } 
        elseif ($val==20) { $pos= '20th';  }
        else              { $pos= 'null';  }
        return $pos;
    }
   
}



if(!function_exists('naira')) {
    function naira() {  return '&#8358;';  }
}