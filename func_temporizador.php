<?php

    require_once 'CAS.php';
    require_once 'config.php';

    // Enable debugging
    phpCAS::setDebug();
    // Initialize phpCAS
    phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
    phpCAS::setNoCasServerValidation();
    // force CAS authentication
    phpCAS::forceAuthentication();
    if (isset($_REQUEST['logout'])) {
        phpCAS::logout();
    }

    $user = phpCAS::getUser();
    
function ejecutar(){

    $ora_db_location = "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = ciruelo)(PORT = 1521))
    (CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME= aleph23))(Client_CSet = UTF-8))";

    $conn = oci_connect("NOR50", "NOR50",  $ora_db_location); 

    //$codigo = 200089061;
    
    if($conn){ 
        
        $user = phpCAS::getUser();

        $sql = "SELECT   Z36_ID AS Codigo,
        LOWER(substr(z308_rec_key,3,40)) Usuario,
        INITCAP(Z303_NAME) AS Nombre,
        z30_note_internal Ubicacion,
        Z30_BARCODE AS Activo,
        INITCAP(LOWER(convert(Z13_TITLE,'WE8ISO8859P1','WE8ISO8859P1'))) AS Portatil,
        to_char(to_date(LPAD(Z36_LOAN_DATE,8,'0'),'yyyymmdd'), 'dd/mm/yyyy') AS Fecha_Prestamo,
        substr(lpad(Z36_LOAN_HOUR,4,'0'),1,2)||':'||substr(lpad(Z36_LOAN_HOUR,4,'0'),3,2) AS Hora_Prestamo,
        to_char(to_date(LPAD(Z36_DUE_DATE,8,'0'),'yyyymmdd'),'dd/mm/yyyy')  AS Fecha_Vencimiento,
        substr(lpad(Z36_DUE_HOUR,4,'0'),1,2)||':'||substr(lpad(Z36_DUE_HOUR,4,'0'),3,2) AS Hora_Vencimiento
        From nor50.Z36
        LEFT JOIN nor50.z30 b on Z36_REC_KEY=Z30_REC_KEY
        LEFT JOIN nor01.z103 z on substr(Z.Z103_REC_KEY,6,9)=substr(Z36_REC_KEY,1,9)
        LEFT JOIN nor01.z13 on Z13_REC_KEY=substr(Z.Z103_REC_KEY_1,6,9)
        LEFT JOIN nor50.Z303 on Z36_ID=Z303_REC_KEY
        LEFT JOIN nor50.Z308 on Z36_ID=Z308_ID AND z308_verification_type='02' AND z308_rec_key like '01%'
        WHERE z36_material='LAPTO'
        and z36_sub_library='INFOR'
        and z.z103_lkr_library='NOR50'
        and Z36_RETURNED_DATE = 0
        and trim(LOWER(substr(z308_rec_key,3,40))) ='".$user."'";

       
    

       /* $sql = "SELECT 
        '200073692' as Codigo,
        'camilalozano' as Usuario,
        'Bloque B 3 Piso' as Ubicacion,
        '10754500' as Activo,
        'Laptop Hp 240 G6 / Hp Development Company.' as Portatil,
        '12/12/2019' as Fecha_prestamo,
        '09:00' as Hora_prestamo,
        '12/12/2019' as Fecha_vencimiento,
        '20:00' as Hora_vencimiento
        from dual
        --and Usuario = $user no puedo hacer esto
        ";*/
        
        
        $stid = oci_parse($conn, $sql);
        oci_execute($stid);

        $res = [];   
            while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {                 
                    array_push($res,$row);  
            }        
        return $res;

    }
}
//print_r(ejecutar());
    ?>

        