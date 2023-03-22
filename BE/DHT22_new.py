import Adafruit_DHT
import math
import time
import DB_func
from DB_func import InsertHumidity

while True:
    humidity, temperature = Adafruit_DHT.read_retry(Adafruit_DHT.DHT22, 4)
    humidity = round(humidity, 2)
    temperature = round(temperature, 2)
   
    if humidity is not None and temperature is not None:

      #print 'Temperatuur: {0:0.1f}*C'.format(temperature)
      humidityFormated =  '{0:0.1f}'.format(humidity)
      print(humidityFormated)
      f = open("demofile2.txt", "w")
      f.write(humidityFormated)
      f.close()
     

    else:
      print ('Geen data')
    time.sleep(10)