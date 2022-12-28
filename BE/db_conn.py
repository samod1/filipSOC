import mysql.connector
from mysql.connector import Error
import mysql.connector
from datetime import datetime
import random



def randomNumberGenerator():
    nahodnecislo = random.randint(0 , 40);
    return nahodnecislo

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

for x in range(30):
    sql= "INSERT INTO filip_soc.tbl_teplota (value, `timestamp`, miesto_merania, jednotka) VALUES(%s, %s, 500011, 2);"
    now = datetime.now()
    timeNow = dt_string = now.strftime("%Y-%m-%d %H:%M:%S")
    hodnota = randomNumberGenerator()
    print(timeNow , hodnota)
    val = (hodnota, timeNow)
    cursor.execute(sql,val)
    mydb.commit()

