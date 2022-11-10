from time import sleep
from gpiozero import InputDevice
 
no_rain = InputDevice(18)
 

while True:
    if not no_rain.is_active:
        print("It's raining - get the washing in!")
        # insert your other code or functions here
        # e.g. tweet, SMS, email, take a photo etc.
    sleep(1)