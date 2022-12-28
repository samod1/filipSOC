#!/usr/bin/python

#funguje iba v priecinku /home/pi/Adafruit-Raspberry-Pi-Python-Code/Adafruit_BMP085
import mysql.connector
from mysql.connector import Error
import mysql.connector
from datetime import datetime
from Adafruit_BMP085 import BMP085

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

 
# ===========================================================================
# Example Code
# ===========================================================================
 
# Initialise the BMP085 and use STANDARD mode (default value)
# bmp = BMP085(0x77, debug=True)

bmp = BMP085(0x77)
 
# To specify a different operating mode, uncomment one of the following:
# bmp = BMP085(0x77, 0)  # ULTRALOWPOWER Mode
# bmp = BMP085(0x77, 1)  # STANDARD Mode
# bmp = BMP085(0x77, 2)  # HIRES Mode
# bmp = BMP085(0x77, 3)  # ULTRAHIRES Mode
 
temp = bmp.readTemperature()
 
# Read the current barometric pressure level
pressure = bmp.readPressure()
 
# To calculate altitude based on an estimated mean sea level pressure
# (1013.25 hPa) call the function as follows, but this won't be very accurate
#altitude = bmp.readAltitude()
 
# To specify a more accurate altitude, enter the correct mean sea level
# pressure level.  For example, if the current pressure level is 1023.50 hPa
# enter 102350 since we include two decimal places in the integer value
# altitude = bmp.readAltitude(102350)
correctPressure = pressure / 100.0

print ("Temperature: %.2f C" % temp)
print ("Pressure:    %.2f hPa" % (pressure / 100.0))
#print ("Altitude:    %.2f" % altitude)

while True :
    sql= "INSERT INTO filip_soc.tbl_tlak (value, `timestamp`, miesto_merania, jednotka) VALUES(%.2f, %s, , 2);"
    now = datetime.now()
    timeNow = dt_string = now.strftime("%Y-%m-%d %H:%M:%S")
    hodnota = correctPressure
    print(timeNow , hodnota)
    val = (hodnota, timeNow)
    cursor.execute(sql,val)
    mydb.commit()

    sql= "INSERT INTO filip_soc.tbl_tlak (value, `timestamp`, miesto_merania, jednotka) VALUES(%.2f, %s, , 2);"
    now = datetime.now()
    timeNow = dt_string = now.strftime("%Y-%m-%d %H:%M:%S")
    hodnotaTeploty = temp
    print(timeNow , hodnotaTeploty)
    val = (hodnotaTeploty, timeNow)
    cursor.execute(sql,val)
    mydb.commit()

#TODO vkladat hodnoty do databazy
#TODO zmazat udaje v databaze
#HACK ak teplota presiahne nejaku konkretnu hodnotu zavolat alarmovu sluzbu, ktora posle mail o nefunkcnosti
#