#! /bin/bash
cd /home/pi/filipSOC/BE
python3 DHT22.py &
python3 bmp180_python3.py &
python3 rain_sensor.py &
python3 soil_sensor.py &