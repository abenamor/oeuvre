#!/bin/bash
nomsite=$(echo $1  | cut -d "/" -f3)
echo $nomsite
mkdir /opt/lampp/htdocs/projet/Sites/$nomsite
cp /opt/lampp/htdocs/projet/scripts/reseauWea.bash /opt/lampp/htdocs/projet/scripts/geo.sh  /opt/lampp/htdocs/projet/scripts/script_recup.py /opt/lampp/htdocs/projet/scripts/traceroute.bash /opt/lampp/htdocs/projet/scripts/gestionDonneesGeo.py /opt/lampp/htdocs/projet/Sites/$nomsite
cp /opt/lampp/htdocs/projet/scripts/geo.sh /opt/lampp/htdocs/projet/scripts/gestionDonneesGeo.py /opt/lampp/htdocs/projet/Sites/listing/$nomsite
cd /opt/lampp/htdocs/projet/Sites/$nomsite 

chmod 755 reseauWea.bash script_recup.py traceroute.bash

#chmod u+s,g+s reseauWea.bash script_recup.py traceroute.bash
./script_recup.py $1
