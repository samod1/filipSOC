import mysql.connector
from mysql.connector import Error


mydb = mysql.connector.connect(
        host="db.dw082.nameserver.sk",
        database="filip_soc",
        user="filip_majchrak",
        password="X5Me1BZj"   
    )

if mydb.is_connected():
        db_Info = mydb.get_server_info()
        print ("Connected to MySQL Server version", db_Info)

#FIXME dokoncit overovanie pre uspesne resp. neuspesne spojenie s databazov
