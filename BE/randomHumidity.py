import random
import time
from DB_func import InsertHumidity

def getRandomHumidity():
    while True:
        randomHumidity: int = random.randint(40,60)
        print(randomHumidity)
        time.sleep(10)
        return randomHumidity

while True:
    print("")
    InsertHumidity(getRandomHumidity())
    print("ok")
