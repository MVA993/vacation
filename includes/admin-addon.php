<?php
    include "../classes/dbconect.php";
    include "../classes/request-model.php";
    include "../classes/request-controler.php";
    include "../classes/request-view.php";

    $employeeId = $loginUsername; //Pretpostavka da sam id zaposlenog izvukao preko imena koje je iskorišćeno za login.

    $requestList = new RequestView($employeeId);



    //Kod koji prikazuje tabelu sa izlistanim zahtevima za odmor.