
from cgitb import html
from email import message
import time
from time import sleep
import random
import smtplib, ssl
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart




port = 465;
SMTPserver = "mailproxy.nameserver.sk";
posielatel = "no-reply@samod.sk";
heslo= "gB6ggB6x";
prijmatel="samuel.domin@samod.sk";

def posliEmail(server,port,sender,password,recipient):
    message = MIMEMultipart("alternative")
    message["Subject"] = "Varovanie vysoka teplota"
    message["From"] = sender
    message["To"] = recipient
    html = """\
        <html>
            <body>
                <h1>Varovanie vo vasom sklenniku je momentalne vysoka teplota
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


def overenieTeploty (maximalna, namerana):
    if(namerana > maximalna):
        posliEmail(SMTPserver,port,posielatel,heslo,prijmatel);
    else:
        print("teplota OK");


def randomNumberGenerator():
    nahodnecislo = random.randint(0,40);
    return nahodnecislo


#main part of programm

maximalna_pripustna_teplota = 35;
print("Maximalna pripustna teplota", maximalna_pripustna_teplota);
x=1;

while True:

    namerana_teplota= randomNumberGenerator();
    print(namerana_teplota);
    overenieTeploty(maximalna_pripustna_teplota,namerana_teplota);
    time.sleep(7200);
    

    

