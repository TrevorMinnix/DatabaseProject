#!..\eds-binaries\python\default\python.exe

#commandline arguments: "recipient address" "email body text"

import smtplib
import sys
import cgi
import urllib

form = cgi.FieldStorage()

fromaddr = 'dbproject.team12@gmail.com'
toaddr  = urllib.unquote_plus(str(form.getvalue('recipient')))
msg = "\n" + urllib.unquote_plus(str(form.getvalue('body')))
username = 'dbproject.team12@gmail.com'
password = 'eqrzqierouywovez'
server = smtplib.SMTP('smtp.gmail.com:587')
server.starttls()
server.login(username,password)
server.sendmail(fromaddr, toaddr, msg)
server.quit()

print "Content-type: text/html"
print
print "<html><head>"
print ""
print toaddr
print msg
#print "</head><body onload=\"document.location=\'Nominator.html\'\"></body>"
print ""
print "</html>"
