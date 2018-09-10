<?php require($_SERVER ["DOCUMENT_ROOT"]."/kejaport/includes/initialize.php")?>
<pre>
    <?php

    $advertisement = new Advertisement();
    
    $advertisement->user_id = 1;
    $advertisement->constituency = 4;
    $advertisement->ward = 17;
    $advertisement->specific_area = 'Kabs';
    $advertisement->agency = 'Nyumba Kumi';
    $advertisement->house_type = 2;
    $advertisement->rent = 7000 ;
    $advertisement->house_count = 1;
    $advertisement->payment_code = 3142;

    // $adarray = $advertisement->find_all()[0];
    // foreach ($adarray as $key => $value) {
    //     echo "$key : $value <br>";
    // }

    $advertisement->create();


    ?>
</pre>
