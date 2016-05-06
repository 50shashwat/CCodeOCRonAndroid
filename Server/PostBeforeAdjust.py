import sys
import re

frequent_words = ['#include', '<stdio.h>', 'int', 'main()', 'char', 'char*' ,'return',\
				  'printf',  'string', 'main'];

delimiters = ',|;| |\n'

def levenshtein(s1, s2):
    if len(s1) < len(s2):
        return levenshtein(s2, s1)
 
    # len(s1) >= len(s2)
    if len(s2) == 0:
        return len(s1)
 
    previous_row = xrange(len(s2) + 1)
    for i, c1 in enumerate(s1):
        current_row = [i + 1]
        for j, c2 in enumerate(s2):
            insertions = previous_row[j + 1] + 1 # j+1 instead of j since previous_row and current_row are one character longer
            deletions = current_row[j] + 1       # than s2
            substitutions = previous_row[j] + (c1 != c2)
            current_row.append(min(insertions, deletions, substitutions))
        previous_row = current_row
 
    return previous_row[-1]

if __name__ == "__main__":
	argv = sys.argv
	in_file = argv[1]
	out_file = argv[2]

	before = open(in_file)
	after = open(out_file, 'w+')
	
	for line in before.readlines():
		line = line.replace('\r', '')
		line = line.replace('\x1c', '\"')
		words = re.split(delimiters, line)
		words = filter(None, words);

		for word in words:
			if (len(word) < 11):
				if (len(word) < 7):
					thresh = 1
				else:
					thresh = 2
				for candidate in frequent_words:	
					ed = levenshtein(word, candidate)
					if (ed <= thresh and ed > 0):
						line = line.replace(word, candidate)
						print line
		after.write(line)