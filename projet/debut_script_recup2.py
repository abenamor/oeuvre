#!/usr/bin/env python2
import sys, urllib2, re, time, os, csv, MySQLdb
try:
	sys.argv[1]
	url= sys.argv[1]
except:
	print("Need an argument")
	sys.exit(2);
os.system("./scripts/url.bash " +url)
