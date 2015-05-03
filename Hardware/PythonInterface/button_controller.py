import sys
import serial
import time

import requests

import socket
import threading

import pickle

import queue

import array

class SerialThread(threading.Thread):

	def handleButtonPress(self):
		r = requests.post("http://bigbutton.dev/buttonpressed.php")

	def setPort(self, port):
		self.port = port

	def run(self):
		while(1):
			evt = self.port.read(1)
			
			if (evt == b'0'):
				print("Got button press.")
				self.handleButtonPress()

			elif len(evt):
				print(ord(evt))

			if not self.q.empty():
				data = self.q.get()
				rgb = pickle.loads(data)
				print("Got RGB values {0}, {1}, {2}".format(rgb[0], rgb[1], rgb[2]))
				self.port.write(rgb)

	def setQueue(self, q):
		self.q = q

class ActionListenerThread(threading.Thread):

	def run(self):
		# create an INET, STREAMing socket
		serversocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
		# bind the socket to a public host, and a well-known port
		print("Listening on {0}".format(socket.gethostname()))
		serversocket.bind((socket.gethostname(), 80))
		# become a server socket
		serversocket.listen(5)

		while(1):
			conn, address = serversocket.accept()
			data = conn.recv(128)
			self.q.put(data)

	def setQueue(self, q):
		self.q = q
	
def run():
	try:
		com = sys.argv[1]
	except IndexError:
		print("No COM port specified!")
		sys.exit(1)
	
	try:
		port = serial.Serial(com, 115200, timeout=0.5)
	except serial.SerialException as e:
		print("Could not open port {0}".format(com))
		sys.exit(1)

	q = queue.Queue()

	serialThread = SerialThread()
	serialThread.setPort(port)
	serialThread.setQueue(q)
	serialThread.daemon = True
	serialThread.start()

	actionListenerThread = ActionListenerThread()
	actionListenerThread.daemon = True
	actionListenerThread.setQueue(q)
	actionListenerThread.start()

	while True:
	    time.sleep(1)

if __name__ == "__main__":
	run()
