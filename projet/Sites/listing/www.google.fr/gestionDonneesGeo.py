#!/usr/bin/env python2
import sys, urllib2, re, time, os, csv, MySQLdb

key= '32ecef7459594891b8ca53cc08aecc7d'
try:
	sys.argv[1]
	url= sys.argv[1]
except:
	print("Need an argument")
	sys.exit(2);


##### DATABASE PART #####
try:
	conn= MySQLdb.connect(db= 'project', user= 'root', passwd= '', host='127.0.0.1')
	print ("connexion reussie")
except:
	print ("La connexion avec la database a fail")

else:
	cursor= conn.cursor()   # creation du curseur
	
	reader= csv.reader(open("cities.csv", "rU"), delimiter=',', dialect= csv.DictReader)
for row in reader:
	print ("voila le row")
	print (row)
	
	if row[0] != 'url':
		code= row[0]
		city= row[1] 
		country= row[2]
		lat= row[3]
		lon= row[4]
		ip= row[5]

		if row[0] == 'Total':
			requete="UPDATE historique SET consommation='" +row[8] +"' WHERE site='" +sys.argv[1] +"'"
			cursor.execute(requete)
		else :
			requete="INSERT INTO geolocalisation (code, city, country, lat, lon, ip) VALUES('" +code +"', '" +city +"', '" +country +"', '" +lat +"', '" +lon +"', '" +ip +"')"
			print (requete)
			cursor.execute (requete)

conn.commit()

cursor.execute ("SELECT * FROM geolocalisation")
results = cursor.fetchall()
for row in results:
	print (row)
	cursor.close ()
conn.close ()

print("Deconnexion reussis")
