import json
from elasticsearch import Elasticsearch

es = Elasticsearch(['198.199.84.154'])

res = es.search(index='fruit-index', body={
	"query" : {
		"query_string" : {
			"default_field" : "description",
			"query" : "large red and green"
		}
	}
})
print("Got %d Hits:" % res['hits']['total'])
for i in range(5):
	print(res['hits']['hits'][i]["_source"]['name'])


#This is the equivalent command line query
# curl -XGET 'http://198.199.84.154:9200/fruit-index/_search' -d '{ "fields" : ["name"], "query": { "query_string" : {"default_field" : "description", "query": "large red" } } }'