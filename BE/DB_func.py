import mysql.connector
from mysql.connector import Error
import mysql.connector
from datetime import datetime

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


def InsertPressure(pressure):
    sql = "INSERT INTO filip_soc.tbl_tlak (value, `timestamp`, miesto_merania, jednotka) VALUES(%s, %s,507296, 2);"
    now = datetime.now()
    timeNow = dt_string = now.strftime("%Y-%m-%d %H:%M:%S")
    hodnota = pressure
    print(timeNow, hodnota)
    val = (hodnota, timeNow)
    cursor.execute(sql, val)
    mydb.commit()

def InsertTemperature(temperature):
    sql = "INSERT INTO filip_soc.tbl_teplota (value, `timestamp`, miesto_merania, jednotka) VALUES(%s, %s,507296, 1);"
    now = datetime.now()
    timeNow = dt_string = now.strftime("%Y-%m-%d %H:%M:%S")
    hodnotaTeploty = format(temperature)
    print(timeNow, hodnotaTeploty)
    val = (hodnotaTeploty, timeNow)
    cursor.execute(sql, val)
    mydb.commit()

def InsertRain(value):
    sql = "INSERT INTO filip_soc.tbl_dazd (hodnota, `timestamp`, miesto_merania) VALUES(%s, %s,%s);"
    now = datetime.now()
    timeNow = dt_string = now.strftime("%Y-%m-%d %H:%M:%S")
    hodnota = value
    miestoMerania = 507296
    print(timeNow, hodnota)
    val = (hodnota, timeNow, miestoMerania)
    cursor.execute(sql, val)
    mydb.commit()

def InsertSoil(value):
    sql = "INSERT INTO filip_soc.tbl_poda (hodnota, `timestamp`, miesto_merania) VALUES(%s, %s,%s);"
    now = datetime.now()
    timeNow = dt_string = now.strftime("%Y-%m-%d %H:%M:%S")
    hodnota = value
    miestoMerania = 507296
    print(timeNow, hodnota)
    val = (hodnota, timeNow, miestoMerania)
    cursor.execute(sql, val)
    mydb.commit()

def InsertHumidity(humidity):
    sql = "INSERT INTO filip_soc.tbl_vlhkost (hodnota, `timestamp`, miesto_merania) VALUES(%s, %s,%s);"
    now = datetime.now()
    timeNow = dt_string = now.strftime("%Y-%m-%d %H:%M:%S")
    hodnota = humidity
    miestoMerania = 507296
    print(timeNow, hodnota)
    val = (hodnota, timeNow, miestoMerania)
    cursor.execute(sql, val)
    mydb.commit()