<?php
$aModule = array(
    'id' => 'deliverysetcheck',
    'title'       => 'Deliveryset-Check',
    'description' =>  array(
        'de'=>'Überprüfung der Versandarten und -Regeln<br><br>
                <b>BENUTZUNG:</b><br><br>
                Bestellung ausführen bis Schritt 3. <br>
                Fehlerbehebung Versandarten:<br>
                <br>
                <b>1. Versandart wird überhaupt nicht angezeigt:</b><br>
                    - für die Versandart Länder und Benutzer überprüfen<br>
                    - im Zweifel bei Länder und Benutzer nichts zuordnen<br>
                    - Versandart aktivieren<br>
                    <br>
                <b>2. Keine gültige Zahlungsart gefunden:</b><br>
                   bei allen Zahlungsarten die in der Versandart zugeordnet sind:<br>
                    - Länder und Benutzergruppen überprüfen<br>
                    - Bedingung Einkaufswert überprüfen (nicht 0-0)<br>
                    - im Zweifel bei Länder und Benutzer nichts zuordnen<br>
                    - Zahlungsart aktivieren<br>
                    <br>
                <b>3. Keine gültige Versandkostenregel gefunden:</b><br>
                   bei allen Versandkostenregeln die in der Versandart zugeordnet sind:<br>
                    - Benutzer, Artikel und Länderzuordnungen überprüfen<br>
                    - im Zweifel keine Benutzer, Artikel und Länder zuordnen<br>
                    - Bedingung überprüfen (nicht 0-0)<br>
                    - Versandkostenregel aktivieren',
        'en'=>'Checks the Deliverysets and -rules<br><br>
                <b>HOW TO USE:</b><br><br>
                Complete Order until Step 3. <br>
                Troubleshooting Errors:<br>
                <br>
                <b>1. Shipping method is not displayed at all:</b><br>
                    - Check Countries and Users assigned to the Shipping method<br>
                    - If you\'re not certain do not assign any Countries and Users<br>
                    - activate Shipping method<br>
                    <br>
                <b>2. No valid Payment method found:</b><br>
                   for all Payment methods assigned to the Shipping method:<br>
                    - Check Countries and Users assigned to the Payment method<br>
                    - Check if the condition is valid (not 0-0)<br>
                    - If you\'re not certain do not assign any Countries and Users<br>
                    - activate Payment method<br>
                    <br>
                <b>3. No valid Shipping Cost Rule found:</b><br>
                   for all Shipping Cost Rules assigned to the Shipping method:<br>
                    - Check Countries and Users assigned to the Shipping Cost Rule<br>
                    - If you\'re not certain do not assign any Countries and Users/Groups<br>
                    - Check if the condition is valid (not 0-0)<br>
                    - activate Shipping Cost Rule',
    ),
    'thumbnail' => 'deliverysetcheck.jpg',
    'version'     => '1.0',
    'url'         => 'http://zunderweb.de',
    'email'       => 'info@zunderweb.de',
    'author'      => 'Zunderweb',

    'extend' => array(
        'oxdeliverysetlist' => 'deliverysetcheck/core/deliverysetcheck_oxdeliverysetlist', 
    ),
);
