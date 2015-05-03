import random
import requests
import dicttoxml
import base64

from requests.auth import HTTPBasicAuth

API_URL = "http://api.musixmatch.com/ws/1.1/"
API_KEY = '1532cd3c0bfdba91e1c5a602bf997c34'

ESENDEX_URL = 'https://api.esendex.com/v1.0/messagedispatcher'

TAYLOR_SWIFT_ID = '259675'
ALBUM_ID_1989 = '19722402'

AUTH_DATA = [
	"EX0159519",
	"chris@cemerson.co.uk",
	"fdPRqcK9nJ3B"
]

def getLyrics(track_id):
	params = {
			'apikey': API_KEY,
			'track_id': track_id
		}

	r = requests.get(API_URL+"track.lyrics.get", params=params)
	json = r.json()

	return json['message']['body']['lyrics']['lyrics_body']

def getTrackList():
	params = {
			'apikey': API_KEY,
			'album_id': ALBUM_ID_1989,
			'f_has_tracks': '1'
		}
	r = requests.get(API_URL+"album.tracks.get", params=params)
	json = r.json()

	track_list = json['message']['body']['track_list']
	track_id_list = [track['track']['track_id'] for track in track_list]

	return track_id_list

def getRandomLyric():
	track_ids = getTrackList()

	random_track_id = random.choice(track_ids)

	lyrics = getLyrics(random_track_id)
	lines = lyrics.split('\n')

	lines = [line for line in lines if len(line) > 10]
	lines = lines[:-1]

	return random.choice(lines)

def sendEsendexSMSRequest(req):
	r = requests.post(ESENDEX_URL, auth=HTTPBasicAuth("chris@cemerson.co.uk", "fdPRqcK9nJ3B"), data = req)
	print(r.status_code)

def sendRandomLyric():

	xml = dicttoxml.dicttoxml(
	{
		'messages':
		{
			'accountreference':'EX0159519',
			'message':
			{
				'to':'07411048014',
				'body':getRandomLyric()
			}
		}
	},
	attr_type=False, root=False)

	sendEsendexSMSRequest(xml)