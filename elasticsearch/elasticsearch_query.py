import json
from elasticsearch import Elasticsearch

#import imp
#elasticsearch = imp.load_source('elasticsearch', '/home/gxie2/gitHub/fruitID/elasticsearch')
#elasticsearch.Elasticsearch()
#from elasticsearch import Elasticsearch

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
# curl -XGET 'http://198.199.84.154:9200/fruit-index/_search' -d '{ "fields" : ["name"], "query": { "query_string" : {"default_field" : "description", "query": "large red and green" } } }'

#This query gets the full text of the passed in fruit. In this example it as an Acai. The name MUST be lowercase, as that is how it is stored within elasticsearch
# curl -XGET 'http://198.199.84.154:9200/fruit-index/_search' -d '{ "query": {"term" : {"name" : "acai" }} }'
