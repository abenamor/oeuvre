#!/bin/bash
rm reseauWea.csv
echo -e "\nINITIALISATION DES VARIABLES"
sed = $1 | sed 'N;s/\n/,/'> modif.csv
#sed -i 's/"//g' modif.csv
mtu=1500
metro="0.000143"
core="0.000251"
box="0.000278"
consoTotal="0.000000"
timeTotal=0
respBodySizeTotal=0
nbTrameTotal='0'
i=0

# RECUPERATION DES NUMEROS DES COLONNES
echo -e "\nAJOUT DES NUMEROS"
echo -e "\n"
awk 'NR==1' modif.csv > ligne.csv 
#sed -i 's/"//g' ligne.csv

echo -e "\nLANCEMENT DU TRACEROUTE"
echo -e "\n"
if [ -e reseauWea.csv ];
then
rm reseauWea.csv
fi
./traceroute.bash modif.csv

echo -e "\nINITIALISATION DU FICHIER CSV"
echo -e "\n"

echo "url;time;respBodySize;mineType;nbTrame;nbHops;timeByTrame;TimeByHops;Conso" > reseauWea.csv

echo -e "\nDEBUT DU TRAITEMENT"
echo -e "\n"

while read device
do

# recuperation des variable du fichier csv"

	url=$(echo $device | cut -d"," -f7 )
	echo $url
	temp=$(echo $device | cut -d"," -f10)
	echo $loadms
	respBodySize=$(echo $device | cut -d"," -f15)
	echo $respBodySize
	typeMine=$(echo $device | cut -d"," -f20)
	echo $typeMine
	nbTrame=$(echo "($respBodySize/$mtu)+1" | bc)
	#urlSimple=$(echo $device | cut -d"," -f$URL | cut -d"/" -f3)
	urlSimple=$(echo $device | cut -d"," -f7 )
	echo $typeMine

# definition du nombre de sauts"

	while read ligne
	do
	
	testUrl=$(echo $ligne | cut -d";" -f1)
	if [[ $urlSimple == $testUrl ]]
	then
		nbHops=$(echo $ligne | cut -d";" -f2)
		#echo $nbHops
		echo ok
	fi

	done < nbHopsUrl.txt

# calcul des différent temps"
	if [[ "$temp" -gt "1000" ]]
	then 
	timeByTrame=$(0)
	else
	timeByTrame=$(echo "scale=3 ;$temp/$nbTrame" | bc)
	fi
	timeByHops=$(echo "scale=3 ;$timeByTrame/$nbHops" | bc)

#calcul de la consommation
	
	#if [[ "$timeByTrame" -gt "1000" ]]
	#then 		
	#conso="0"
	#else
	conso=$(echo "scale=6 ;((($nbHops - 2)* $timeByHops * $metro) + ($timeByHops * $metro) + ($timeByHops * $box) * $nbTrame)" | bc)
	#fi
#generation du fichier csv

	echo $urlSimple";"$temp";"$respBodySize";"$typeMine";"$nbTrame";"$nbHops";"$timeByTrame";"$timeByHops";"$conso >> reseauWea.csv
	
#calcul des totaux"
	
	timeTotal=$(echo "scale=6 ; ($timeTotal + $temp)" | bc)
	consoTotal=$(echo "scale=6 ; ($consoTotal + 0$conso)" | bc)
	
done < modif.csv

# ajout des totaux au fichier csv"
echo -e "\nFIN DU TRAITEMENT"
echo -e "\n"

echo "Total;"$timeTotal";;;;;;;"$consoTotal >> reseauWea.csv
echo $consoTotal > total
sed -i '2d' reseauWea.csv
awk 'NR==2' reseauWea.csv > temp.csv
nomsite=$(cat temp.csv | cut -d";" -f1)
mkdir /opt/lampp/htdocs/projet/Sites/listing/$nomsite
mv -f ligne.csv modif.csv total nbHopsUrl.txt requests.csv  /opt/lampp/htdocs/projet/Sites/listing/$nomsite
cp -f reseauWea.csv  /opt/lampp/htdocs/projet/Sites/listing/$nomsite
rm temp.csv

exit
