import json
from elasticsearch import Elasticsearch

es = Elasticsearch(['198.199.84.154'])

res = es.search(index='fruit-index', body={
	"query" : {
		"query_string" : {
			"default_field" : "description",
			"query" : "pear shaped green seed"
		}
	}
})
print("Got %d Hits:" % res['hits']['total'])
for i in range(min(10, res['hits']['total'])):
	print(res['hits']['hits'][i]["_source"]['name'])


#This is the equivalent command line query
# curl -XGET 'http://198.199.84.154:9200/fruit-index/_search' -d '{ "fields" : ["name"], "query": { "query_string" : {"default_field" : "description", "query": ""query" : "large red and green" } } }'
