import smtplib, ssl
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
from cgitb import html
from email import message

import mysql.connector
from mysql.connector import Error
import mysql.connector
from datetime import datetime
from time import sleep
from gpiozero import InputDevice

no_rain = InputDevice(18)

port = 465
SMTPserver = "mailproxy.nameserver.sk"
posielatel = "no-reply@samod.sk"
heslo= "gB6ggB6x"
prijmatel="samuel.domin@samod.sk"

def posliEmail(server,port,sender,password,recipient):
    message = MIMEMultipart("alternative")
    message["Subject"] = "Varovanie prsanie"
    message["From"] = sender
    message["To"] = recipient
    html = """\
        <html>
            <body>
                <h1>Prsi, moznost zmoknutia pradla.</h1>
            </body>
        </html> """
    part2= MIMEText(html,"html")
    message.attach(part2)
    
    context = ssl.create_default_context()
    with smtplib.SMTP_SSL(server,port,context=context) as Emailserver:
        Emailserver.login(sender, password)
        Emailserver.sendmail(
            sender, recipient, message.as_string()
    )


mydb = mysql.connector.connect(
        host="db.dw082.nameserver.sk",
        database="filip_soc",
        user="filip_majchrak",
        password="X5Me1BZj"   
    )

if mydb.is_connected():
        db_Info = mydb.get_server_info()
        print ("Connected to MySQL Server version", db_Info)

        cursor=mydb.cursor()

while True:
    if not no_rain.is_active:
        print("It's raining - get the washing in!")
        sql= "INSERT INTO filip_soc.tbl_dazd (hodnota, `timestamp`, miesto_merania, jednotka) VALUES('1', %s,, 2);"
        now = datetime.now()
        timeNow = dt_string = now.strftime("%Y-%m-%d %H:%M:%S")
        hodnota = correctPressure
        print(timeNow , hodnota)
        val = (hodnota, timeNow)
        cursor.execute(sql,val)
        mydb.commit()
        posliEmail(SMTPserver,port,posielatel,heslo,prijmatel)

    else:
        sql= "INSERT INTO filip_soc.tbl_dazd (hodnota, `timestamp`, miesto_merania, jednotka) VALUES('0', %s,, 2);"
        now = datetime.now()
        timeNow = dt_string = now.strftime("%Y-%m-%d %H:%M:%S")
        hodnota = correctPressure
        print(timeNow , hodnota)
        val = (hodnota, timeNow)
        cursor.execute(sql,val)
        mydb.commit()
    sleep(100)