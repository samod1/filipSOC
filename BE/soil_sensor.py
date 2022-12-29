#!/usr/bin/python

# Start by importing the libraries we want to use

import RPi.GPIO as GPIO # This is the GPIO library we need to use the GPIO pins on the Raspberry Pi
import time # This is the time library, we need this so we can use the sleep function
import Email
from DB_func import InsertSoil

port = 465
SMTPserver = "mailproxy.nameserver.sk"
posielatel = "no-reply@samod.sk"
heslo= "gB6ggB6x"
prijmatel="samuel.domin@samod.sk"





def callback(channel):  
    if GPIO.input(channel):
        print ("LED off")
        Email.posliEmailNeg(SMTPserver,port,posielatel,heslo,prijmatel)
        InsertSoil(0)
    else:
        print ("LED on")
        Email.posliEmailPozit(SMTPserver, port, posielatel, heslo, prijmatel)
        InsertSoil(1)
GPIO.setmode(GPIO.BCM)

channel = 21
GPIO.setup(channel, GPIO.IN)

GPIO.add_event_detect(channel, GPIO.BOTH, bouncetime=300)
GPIO.add_event_callback(channel, callback)

while True:
    time.sleep(0.1)
