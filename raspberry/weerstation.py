import os
import threading
import urllib2
from sense_hat import SenseHat

sense = SenseHat()

def readSensor():

    global temperature
    global humidity
    global cpu_temp

    cpu_temp = 0
    temperature =0
    humidity = 0

    temperature = sense.get_temperature()
    humidity = sense.get_humidity()+16.5

    temperature = round(temperature,1)
    humidity = round(humidity,1)

def readCPUTemperature():
    global temperature

    cpu_temp = os.popen("/opt/vc/bin/vcgencmd measure_temp").read()
    cpu_temp = cpu_temp[:-3]
    cpu_temp = cpu_temp[5:]

    temperature = sense.get_temperature()

    print(cpu_temp)

    if cpu_temp == "42.9":
        temperature = temperature - 8.2
    elif cpu_temp == "44.0":
        temperature = temperature - 8.5
    elif cpu_temp == "44.5":
        temperature = temperature - 8.7
    elif cpu_temp == "45.1":
        temperature = temperature - 9.0
    elif cpu_temp == "46.7":
        temperature = temperature - 9.1
    elif cpu_temp == "47.2":
        temperature = temperature - 9.2
    elif cpu_temp == "47.8":
        temperature = temperature - 9.3
    elif cpu_temp == "48.3":
        temperature = temperature - 9.35
    elif cpu_temp == "48.9":
        temperature = temperature - 9.4
    else:
        temperature = temperature - 9.5

def sendDataToServer():
    global temperature
    global humidity

    threading.Timer(10,sendDataToServer).start()
    print("Sensing...")
    readSensor()
    readCPUTemperature()
    temperature = round(temperature,1)
    print(temperature)
    print(humidity)
    temp= "%.1f" %temperature
    hum ="%.1f" %humidity
    urllib2.urlopen("http://11903685.pxl-ea-ict.be/Iot/add_data.php?temp="+temp+"&hum="+hum).read()
    
sendDataToServer()