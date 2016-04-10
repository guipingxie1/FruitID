import json
from elasticsearch import Elasticsearch

es = Elasticsearch(['198.199.84.154'])
fruitlist = {}

with open('fruitlist.json') as json_file:
	fruitlist = json.load(json_file)

for key, value in fruitlist.iteritems():
	res = es.index(index='fruit-index', doc_type="fruit-doc", body=value)
	print(res)

es.indices.refresh()