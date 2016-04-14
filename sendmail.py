#!C:\Program Files (x86)\EasyPHP-Devserver-16.1\eds-binaries\python\default\python.exe

#commandline arguments: "recipient address" "email body text"

import smtplib
import sys
import cgi

form = cgi.FieldStorage()

fromaddr = 'dbproject.team12@gmail.com'
toaddr  = str(form.getvalue('recipient'))
msg = str(form.getvalue('body'))
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
print "</head><body>"
print "Email Sent"
print "</body></html>"