import sys
import datetime
import time
from selenium import webdriver
from selenium.webdriver.support.ui import Select
import mysql.connector as mysql
from selenium.webdriver.support import expected_conditions as EC
db = mysql.connect(
    host = "localhost",
    user = "root",
    passwd = "",
    database = "projet"
)
cursor = db.cursor()

link = sys.argv[4]
datefrom = sys.argv[1]
dateto = sys.argv[2]
id = str(sys.argv[3])
jour=int(datefrom[0:2])
mois=int(datefrom[3:5])
annee=int(datefrom[6:])
dated=''
driver = webdriver.Chrome()
driver.get(link)
driver.implicitly_wait(12)
try:
    while(datefrom!=dateto):
        obj=driver.find_element_by_xpath("//*[@id='dCheckInDateHB']/input")
        obj.clear()
        time.sleep(3)
        obj.send_keys(datefrom)
        time.sleep(2)
        driver.find_element_by_xpath('//*[@id="btnSearch"]').click()
        time.sleep(5)
        price=driver.find_element_by_id("txtPackagePrice").text
        print( datefrom +"  "+price)
        res=cursor.execute("SELECT COUNT(*) FROM provider_hotel_prix where date='"+datefrom+"' and providerhotels_id='"+id+"'")
        lenth=cursor.fetchone()

        if(lenth[0]==0):
            query="INSERT INTO provider_hotel_prix (date, prix,providerhotels_id, type_de_chambre) VALUES (%s, %s,%s,%s)"
            print(price)
            values = (datefrom, price, id,"Chambre Standard")
            cursor.execute(query, values)
            db.commit()
            
        else:
            query="update provider_hotel_prix set prix='"+price+"' where date='"+datefrom+"' and providerhotels_id='"+id+"'"
            cursor.execute(query)
            db.commit()

        date = datetime.date(annee, mois, jour) # (année, mois, jour, heure, minute)
        duree_de_un_jour = datetime.timedelta(1) # Représente la durée d'une journée
        dat=date + duree_de_un_jour
        demain = str(date + duree_de_un_jour)
        d = datetime.datetime.strptime(demain, '%Y-%m-%d').strftime('%d/%m/%Y')
        datefrom=str(d)
        jour = int(dat.day)
        mois = int(dat.month)
        annee = int(dat.year)
except:
    driver.quit()
driver.close()
driver.quit()
exit()







