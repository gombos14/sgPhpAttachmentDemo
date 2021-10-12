<?php
    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['company']) && isset($_POST['phone']) && isset($_POST['email']) && 
        isset($_POST['deliveryDay']) && isset($_POST['installationStartingPoint']) && isset($_POST['installationEndingPoint']) && 
        isset($_POST['breakingTime']) && isset($_POST['contact']))
    {
        $file = fopen($_POST['firstname'].$_POST['lastname'].'.csv', 'w');
        fputcsv($file, array('Családnév', 'Utónév', 'Cég neve', 'Telefonszám', 'E-mail', 'Pontos cím', 'Installálás kezdetének időpontja', 'Installálás befejezésének időpontja', 'Bontás időpontja, ideje', 'Kontakt a helyszínen (mobil)'));

        fputcsv($file, array($_POST['firstname'], $_POST['lastname'], $_POST['company'], $_POST['phone'], $_POST['email'], $_POST['deliveryDay'], $_POST['installationStartingPoint'], $_POST['installationEndingPoint'], $_POST['breakingTime'], $_POST['contact']));

        fclose($file);

        echo 'successfully converted';

        session_start();
        $_SESSION['fileName'] = $_POST['firstname'].$_POST['lastname'].'.csv';

        require_once 'send_email.php';
    }
    else
    {
        echo 'something is fucked up';
    }
