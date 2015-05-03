import sys
import socket
import pickle

def run():
	r = int(sys.argv[1])
	g = int(sys.argv[2])
	b = int(sys.argv[3])

	# create an INET, STREAMing socket
	serversocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	# bind the socket to a public host, and a well-known port
	serversocket.connect((socket.gethostname(), 80))
	data = pickle.dumps([r,g,b])
	serversocket.send(data)

if __name__ == "__main__":
	run()
