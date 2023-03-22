import time
import DB_func
from DB_func import InsertHumidity

while True:
    f = open("demofile.txt", "r")

    humidityTxt=f.read()
    DB_func.InsertHumidity(humidity)
    time.sleep(11)