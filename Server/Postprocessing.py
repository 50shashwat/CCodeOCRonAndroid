import sys

if __name__ == "__main__":
	argv = sys.argv
	in_file = argv[1]
	out_file = argv[2]

	before = open(in_file)
	after = open(out_file, 'w+')
	
	for line in before.readlines():
		line = line.replace('\r', '')
		line = line.replace('\x1c', '\"')
		after.write(line)