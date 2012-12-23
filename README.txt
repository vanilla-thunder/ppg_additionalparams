Beschreibung:
Das Modul wurde unter OXID eSales CE V. 4.7.1 geschrieben. Andere Versionen wurden nicht ausprobiert.
Das Modul erweitert die Möglichkeit der Freitextparameter für die Artikel. Nach dem Aktivieren erschein in der Artikelverwaltung im Tab "Erweitert" ein zusätzliches Feld, in das die zusätzlichen Parameter eingetragen werden können. Dabei die folgende Schreibweise verwenden: "Name1|Name2|Name3|...".

Die Anzeige der Parameter wird nur dann angezeigt, wenn die Option "Artikel ist individualisierbar" aktiviert wurde.

-----------------------------------------------
So wird das Modul installiert:

1. Update der Datenbank (zusätzliches Feld in oxarticles):
Datei UPDATE_OXARTICLES.sql im Admin via Service->Tools importieren oder folgendes ausführen:

ALTER TABLE `oxarticles` ADD `OXADDPARAMS` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

2. Inhalt des Ordners "copy_this" ins root-Verzeichnis des Shops kopieren.

3. Im Adminbereich unter "Erweiterungen->Module->Additional PersParams" aktivieren.