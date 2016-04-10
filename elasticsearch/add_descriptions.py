import json

fruitlist = {}
fruit_info = []

with open('initialfruitlist.json') as json_file:
	fruitlist = json.load(json_file)

with open("../special_fruits.txt") as text_file:
	temp = text_file.read()
	fruit_info = temp.split("--------------------------------------------------------------------------------")

fruit_info.pop(0)

for i in range(len(fruit_info)):
	fruit_info[i] = fruit_info[i].strip()

for i in fruit_info:
	split = i.splitlines()
	name = split[0]
	desc = ""
	facts = ""
	geo = ""
	for j in range(len(split)):
		if split[j] == "Description/Taste":
			desc = split[j + 1]
		elif split[j] == "Current Facts":
			facts = split[j + 1]
		elif split[j] == "Geography/History":
			geo = split[j + 1]
	fruitlist[name]["name"] = name
	fruitlist[name]["description"] = "%s %s %s %s" % (name, desc, facts, geo)
	fruitlist[name]["full"] = i

with open('fruitlist.json', "w") as json_file:
	json_file.write(json.dumps(fruitlist, sort_keys=True, indent=4, separators=(',', ': ')))