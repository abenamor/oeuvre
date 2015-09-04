#!/bin/bash
rm cities.csv ip.csv
sed -i 's/"//g' $1
while read ligne
do
	ip=$(echo $ligne | cut -d"," -f4)
	echo $ip >> ip.csv
done < $1
sed -i '1d' ip.csv
echo "code,city,country,lat,lon,ip" > cities.csv
ip_first=$(head -n1 ip.csv)
GeoIP=$(geoiplookup -f /usr/share/GeoIP/GeoLiteCity.dat $ip_first)
code=$(echo $GeoIP | cut -d "," -f3)
city=$(echo $GeoIP | cut -d "," -f4)
country=$(echo $GeoIP | cut -d "," -f2 | cut -d ":" -f2)
lat=$(echo $GeoIP | cut -d "," -f7)
lon=$(echo $GeoIP | cut -d "," -f8)
ip=$ip_first
echo $code","$city","$country","$lat","$lon","$ip >> cities.csv
cat ip.csv | sort | uniq > tmp.csv
sed -i '/0.0.0.0/d' tmp.csv
sed -i '/$ip_first/d' tmp.csv
while read ligne
	do
	GeoIP=$(geoiplookup -f /usr/share/GeoIP/GeoLiteCity.dat $ligne)
	code=$(echo $GeoIP | cut -d "," -f3)
	city=$(echo $GeoIP | cut -d "," -f4)
	country=$(echo $GeoIP | cut -d "," -f2 | cut -d ":" -f2)
	lat=$(echo $GeoIP | cut -d "," -f7)
	lon=$(echo $GeoIP | cut -d "," -f8)
	ip=$ligne
	echo $code","$city","$country","$lat","$lon","$ip >> cities.csv
done < tmp.csv
rm tmp.csv
