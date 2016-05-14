import json
import subprocess
import string
from elasticsearch import Elasticsearch

es = Elasticsearch(['198.199.84.154'])
fruitlist = {}
synonyms = ""
syn_list = []
syn_str = ""

with open('fruitlist.json') as json_file:
	fruitlist = json.load(json_file)

with open('synonyms.txt') as syn_file:
	synonyms = syn_file.read()
	syn_list = string.split(synonyms, "|")
	syn_str = str(syn_list).replace("'", "\"")

index = "fruit-index"

subprocess.call("curl -XDELETE 'http://198.199.84.154:9200/%s/'" % index, shell=True)
create_index = "curl -PUT 'http://198.199.84.154:9200/%s' -d '{ \"mappings\" : {\"fruit-doc\" : {\"properties\" : {\"description\" : {\"type\" : \"string\", \"analyzer\":\"remove\"}}}}, \"settings\": { \"analysis\": {\"filter\": { \"en_US\": {\"type\": \"hunspell\", \"language\": \"en_US\"}, \"english_stemmer\": {\"type\": \"stemmer\",\"language\": \"english\" },\"english_possessive_stemmer\": {\"type\": \"stemmer\", \"language\":  \"possessive_english\"}, \"my_synonym_filter\": {\"type\": \"synonym\", \"synonyms\" :" % index
create_index +=  syn_str
create_index += "},\"my_stop\": {\"type\" : \"stop\", \"stopwords\" : \"_english_\"}},\"analyzer\": {\"remove\": {\"tokenizer\": \"standard\",\"filter\": [\"english_possessive_stemmer\", \"lowercase\", \"my_stop\", \"my_synonym_filter\",\"en_US\"]}}}}}'"
subprocess.call(create_index, shell=True)

for key, value in fruitlist.iteritems():
	res = es.index(index="%s" % index, doc_type="fruit-doc", body=value)
	print(res)

es.indices.refresh