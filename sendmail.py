#!C:\Program Files (x86)\EasyPHP-Devserver-16.1\eds-binaries\python\default\python.exe

#commandline arguments: "recipient address" "email body text"

import smtplib
import sys

fromaddr = 'dbproject.team12@gmail.com'
toaddr  = str(sys.argv[1])
msg = str(sys.argv[2])
username = 'dbproject.team12@gmail.com'
password = 'eqrzqierouywovez'
server = smtplib.SMTP('smtp.gmail.com:587')
server.starttls()
server.login(username,password)
server.sendmail(fromaddr, toaddr, msg)
server.quit()
