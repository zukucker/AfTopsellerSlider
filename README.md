# Topseller Slider Plugin(Shopware 6.6.9.0)
Kleines Plugin welches einen Topseller Slider als CMS Element möglich macht.<br>
Es wird auf die aktiven Produkte des Sales Channels zugegriffen, diese werden nach Anzahl der Verkäufe sortiert und limitiert auf die Plugin Konfiguration.<br>
Dort kann man ebenso die Reihenfolge auswählen ob Aufsteigend oder Absteigend.<br>

## Installation:
Unter [Releases](https://github.com/zukucker/AfTopsellerSlider/releases) aktuellen Release holen.<br>
Die Zipdatei unter custom/plugins hinterlegen und entpacken.<br>
Entweder über die Administration das Plugin installieren & aktivieren oder per Console:

```bash
bin/console plugin:refresh && bin/console plugin:install --activate AfTopsellerSlider
```

```bash
bin/console cache:clear && bin/console theme:compile
```
```bash
bin/build-administration.sh
```

ausführen.

Bei Fragen oder Anregungen gerne via Twitter oder Shopware Forum:<br>
[Shopware Forum - MrAle](https://forum.shopware.com/u/mrale/summary)<br>
[Twitter](https://x.com/FroehlingA)<br>


![Screenshot 2025-01-26 135209](https://github.com/user-attachments/assets/b11be6a5-68b9-4cc5-bb94-d1b47794ad26)
![image](https://github.com/user-attachments/assets/852eb0ca-ffd5-4490-8c4d-46b19a5a2b74)
![Screenshot 2025-01-26 135148](https://github.com/user-attachments/assets/66c6b689-d384-489b-b7b1-e4095ca05487)
