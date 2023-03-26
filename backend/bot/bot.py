import sys
import time
import telepot
from telepot.loop import MessageLoop
from pprint import pprint
import json
import requests

TOKEN = '' # ~ copiare token bot
isWelcome = 0

def on_chat_message(msg):
    content_type, chat_type, chat_id = telepot.glance(msg)
    print(content_type, chat_type, chat_id)
    # pprint(msg)

    global isWelcome

    if msg['text'] == '/start' and isWelcome == 0:
        bot.sendMessage(chat_id, 'Benvenuto su <b>BrentAlert</b>!', parse_mode = 'html')
        isWelcome = 1
    elif msg['text'] == '/livelloattuale':
		try:
			# ~ http://brentalert2020.altervista.org/api/brentaLevel.php
			resp = requests.get('http://brentalert2020.altervista.org/api/brentaLevel.php')
			data = json.loads(resp.text)
			sensore = data['STAZIONE']['SENSORE'][0]['DATI']
			for x in sensore[::-1]:
				if x['VM'] != '>>':
					liv = x['VM']
					d_ist = x['@attributes']['ISTANTE']
					break
			oNow = '<b>'+d_ist[8]+d_ist[9]+':'+d_ist[10]+d_ist[11]+'</b>'
			dNow = '<b>'+d_ist[6]+d_ist[7]+'/'+d_ist[4]+d_ist[5]+'/'+d_ist[0]+d_ist[1]+d_ist[2]+d_ist[3]+'</b>'
			bot.sendMessage(chat_id, 'Livello attuale del fiume Brenta: <b>'+liv+' m</b>\nData ultimo rilevamento: '+dNow+'\nOra ultimo rilevamento: '+oNow+' - <b>Ora solare</b>', parse_mode = 'html')
		except:
			bot.sendMessage(chat_id, 'Livello attuale del fiume Brenta non disponibile!\n<b>Riprova pi&#249; tardi</b>', parse_mode = 'html')
    elif msg['text'] == '/livellolimite':
        bot.sendMessage(chat_id, 'Livello limite del fiume Brenta previsto come soglia di sicurezza: <b>3.24 m</b>', parse_mode = 'html')
    elif msg['text'] == '/help' or msg['text'] == '/start':
        bot.sendMessage(chat_id, '<b>Lista comandi</b>:\n *  /livelloattuale - mostra il livello attuale\n *  /livellolimite - mostra il livello limite\n *  /help - mostra l\'elenco dei comandi', parse_mode = 'html')
    else:
        bot.sendMessage(chat_id, 'Mi dispiace, non capisco')


bot = telepot.Bot(TOKEN)
bot.message_loop(on_chat_message)

print('Listening ...')
while 1:
    time.sleep(10)
