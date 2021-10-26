        if ($balance) {
              $b =  explode(':', $balance->balance);
              $b_right = $b[0];
              $b_left = $b[1];
              if ($b_left==0 || $b_right==0) {
                if ($placement=='r') {
                  $right = $balance->rigt+$pv;
                  $left = $balance->rigt;
                }
              }else{

              }

         }else{
          if ($placement=='r') {
            $right = $pv;
            $left = 0;
          }else{
            $right = 0;
            $left = $pv;
          }
          $balance = $right.':'.$left;
        }
