import smtplib, ssl
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
from cgitb import html
from email import message

import mysql.connector
from mysql.connector import Error
from datetime import datetime
from time import sleep
from gpiozero import InputDevice
from DB_func import InsertRain
from Email import SendEmail

no_rain = InputDevice(18)

port = 465
SMTPserver = "mailproxy.nameserver.sk"
posielatel = "no-reply@samod.sk"
heslo= "gB6ggB6x"
prijmatel="samuel.domin@samod.sk"


while True:
    if not no_rain.is_active:
        print("It's raining - get the washing in!")
        InsertRain(1)
        SendEmail(SMTPserver,port,posielatel,heslo,prijmatel)

    else:
        InsertRain(0)
    sleep(90)

