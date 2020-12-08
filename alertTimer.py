import time
import webbrowser
import datetime
from urllib.request import Request, urlopen
while True:
    req = Request('https://azuolynogimnazija.renginiai.it/events/alert', headers={'User-Agent': 'Mozilla/5.0'})
    webpage = urlopen(req).read()
    print(datetime.datetime.now())
    time.sleep(86400)
