# By Arvind Kouta and Alvin Ling

import nltk
from nltk.corpus import wordnet as wn

synonyms = {}
words = ['tiny', 'big', 'small', 'juicy', 'blue', 'yellow', 'red', 'green', 'purple', 'black', 'orange', 'white',
'gigantic','aromatic','bountiful','bright','buttery','clean','colorful','cool','creamy','delicious','exotic','exquisite','firm','flavorful',
'fleshy','fragrant','fresh','generous','harmonious','heady','healthy','hearty','intense','jammy','juicy','jumbo','layered','light','long','luscious',
'luxurious','moist','naked','nourishing','nutritious','plump','plush','pulpy','raw','refreshing','rich','ripe','round','seasonal','silky','sleek','small',
'smooth','soft','sour','strong','supple','sweet','tangy','tart','thick','tropical','viscous','voluptuous','young','zesty']

for word in words:
	synonyms[word] = []
	for synset in wn.synsets(word):
	    for lemma in synset.lemmas():
	    	syn = lemma.name()
	    	if syn not in synonyms[word]:
	    		synonyms[word].append(syn)

def formatSyn(word, syns):
	return "\\\"{}, {}\\\"".format(word, ", ".join(syns))

def printsynlines():
	for word in synonyms:
		if(synonyms[word]): print(formatSyn(word, synonyms[word]),"\n")

all_syns = []
for word in synonyms:
	if(synonyms[word]):
		all_syns.append(formatSyn(word, synonyms[word]))

with open("synonyms.txt", "w") as text_file:
	syn_string = ", ".join(all_syns)
	text_file.write(syn_string)

#\"type\": \"synonym\", \"synonyms\": [ \"large,big\",\"small,tiny\"