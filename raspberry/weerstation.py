import os
import threading
import urllib2
import socket
from sense_hat import SenseHat

sense = SenseHat()

def get_ip():
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    try:
        s.connect(('10.255.255.255', 1))
        IP = s.getsockname()[0]
    except Exception:
        IP = '127.0.0.1'
    finally: s.close()
    return IP

def readTemperature():

    global temperature
    global cpu_temp

    cpu_temp = 0
    temperature =0

    temperature = sense.get_temperature()
    temperature = round(temperature,1)

def readHumidity():
    
    global humidity

    humidity = 0

    humidity = sense.get_humidity()+16.5
    humidity = round(humidity,1)

def readCPUTemperature():
    global temperature

    cpu_temp = os.popen("/opt/vc/bin/vcgencmd measure_temp").read()
    cpu_temp = cpu_temp[:-3]
    cpu_temp = cpu_temp[5:]

    temperature = sense.get_temperature()

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

def sendTemperatureToServer():
    global temperature
    
    readTemperature()
    readCPUTemperature()
    IP_adress = get_ip()

    threading.Timer(10,sendTemperatureToServer).start()
    print("Sensing...")
    
    temperature = round(temperature,1)
    print(temperature)
    print(IP_adress)
    
    temp= "%.1f" %temperature
    urllib2.urlopen("http://11903685.pxl-ea-ict.be/Iot/add_data.php?ID=1&Value="+temp+"&IP_adress="+IP_adress).read()

def sendHumidityToServer():
    global humidity
    
    readHumidity()
    IP_adress = get_ip()

    threading.Timer(13,sendHumidityToServer).start()
    print("Sensing...")    
    print(humidity)
    print(IP_adress)
    
    hum ="%.1f" %humidity
    urllib2.urlopen("http://11903685.pxl-ea-ict.be/Iot/add_data.php?ID=2&Value="+hum+"&IP_adress="+IP_adress).read()


sendTemperatureToServer()
sendHumidityToServer()