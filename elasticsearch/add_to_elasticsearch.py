import json
import subprocess
from elasticsearch import Elasticsearch

es = Elasticsearch(['198.199.84.154'])
fruitlist = {}

with open('fruitlist.json') as json_file:
	fruitlist = json.load(json_file)

index = "fruit-index"

subprocess.call("curl -XDELETE 'http://198.199.84.154:9200/%s/'" % index, shell=True)
subprocess.call("curl -PUT 'http://198.199.84.154:9200/%s' -d '{ \"settings\": { \"analysis\": {\"filter\": { \"en_US\": {\"type\": \"hunspell\", \"language\": \"en_US\"}, \"english_stemmer\": {\"type\": \"stemmer\",\"language\": \"english\" },\"english_possessive_stemmer\": {\"type\": \"stemmer\", \"language\":  \"possessive_english\"}, \"my_synonym_filter\": {\"type\": \"synonym\", \"synonyms\": [ \"large,big\",\"small,tiny\"]},\"my_stop\": {\"type\" : \"stop\", \"stopwords\" : \"_english_\"}},\"analyzer\": {\"remove\": {\"tokenizer\": \"standard\",\"filter\": [\"english_possessive_stemmer\", \"lowercase\", \"my_stop\", \"my_synonym_filter\",\"en_US\"]}}}}}'" % index, shell=True)

for key, value in fruitlist.iteritems():
	res = es.index(index="%s" % index, doc_type="fruit-doc", body=value)
	print(res)

es.indices.refresh