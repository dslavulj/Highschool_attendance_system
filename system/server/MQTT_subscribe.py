import time
import paho.mqtt.client as paho
import mysql.connector
from datetime import datetime

#odreduje koji je skolski sat prema trenutnom vremenu koristi UTC vrijeme (-2h od nasega)
def getsksat():
    now=datetime.now().strftime('%H:%M')
    if "06:00" < now < "06:45":
        sksat=1
    elif "06:50" < now < "07:35":
        sksat=2
    elif "07:40" < now < "08:25":
        sksat=3
    elif "08:40" < now < "09:25":
        sksat=4
    elif "09:30" < now < "10:15":
        sksat=5
    elif "10:20" < now < "11:05":
        sksat=6
    elif "11:10" < now < "11:55":
        sksat=7
    else:
        sksat=False
    return sksat

def on_connect(client, userdata, flags, rc):
    print('Client connected')
    print("subscribing ")
    client.subscribe("ucionica")

def on_disconnect(client, userdata, rc):
    if rc != 0:
        print('Unexpected disconnection.')

#funkcija sta da napravi kad dobije podatak sa mqtt brokera
def on_message(client, userdata, message):
    iducionica,uid = str(message.payload.decode("utf-8")).split("/ ")

    #iz baze pomocu id ucionice iz koje je podatak dosao i trenutnom skolskom satu uzima id predmeta
    mycursor = link.cursor()
    sql="SELECT id FROM Raspored WHERE ucionicaID="+ str(iducionica) + " AND skolski_sat="+str(getsksat())
    mycursor.execute(sql)
    rasporedid = mycursor.fetchone()[0]

    #iz baze pomocu uid kartice uzima o kojem se uceniku radi
    mycursor = link.cursor()
    sql="SELECT id FROM Ucenici WHERE UID=\'"+ uid +"\'"
    mycursor.execute(sql)
    idstudent = mycursor.fetchone()[0]

    #provjerava da li taj dolazak vec postoji
    mycursor = link.cursor()
    sql="SELECT id FROM Dolasci WHERE ucenikID = "+ str(idstudent) +" AND rasporedID= "+ str(rasporedid) + " AND datum= \'"+ datetime.now().strftime('%Y-%m-%d')+"\'"
    mycursor.execute(sql)
    msg = mycursor.fetchone()
    if not msg:
        #ako dolazak ne postoji upisuje dolazak u bazu
        sql = "INSERT INTO Dolasci (ucenikID, rasporedID, datum) VALUES (%s, %s, %s)"
        val = (idstudent, rasporedid,datetime.now().strftime('%Y-%m-%d'))
        mycursor.execute(sql, val)
        link.commit()


#konekcija na bazu
link = mysql.connector.connect(
  host="192.168.56.105",
  user="X",
  passwd="X",
  database="Srednja Skola"
)


#konekcija na mqtt broker
broker="192.168.56.105"
client= paho.Client("client-001")

client.on_connect = on_connect
client.on_message = on_message
client.on_disconnect = on_disconnect

print("connecting to broker ",broker)
client.connect(broker)

client.loop_forever()
