#!/bin/bash
sed -i 's/"//g' modif.csv
while read device
do
url=$(echo $device | cut -d"," -f7)
echo $url >> url.txt

done < $1

sort -u url.txt > tracert.txt

while read device
do

traceroute -m20 -I $device  > temp.txt
        nbHops=$(awk 'END {print}' temp.txt | cut -d\  -f1)
        if [[ $nbHops == "" ]]
        then
                nbHops=$(awk 'END {print}' temp.txt | cut -d\  -f2)
        fi
echo $device";"$nbHops >> nbHopsUrl.txt

done < tracert.txt

rm tracert.txt
rm url.txt
rm temp.txt
echo "FIN DU TRACEROUTE"

exit
