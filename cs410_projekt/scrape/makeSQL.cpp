#include <bits/stdc++.h>
using namespace std;

map<string, string> units;

string names[] = {"Calories", "Protein", "Fat", "Carbohydrates", "Fiber", "Sugars", "Calcium", "Iron", "Magnesium", "Phosphorus", "Potassium", "Sodium", "Zinc", "Vitamin C", "Thiamin", "Riboflavin", "Niacin", "Vitamin B-6", "Folate", "Vitamin B-12", "Vitamin A", "Vitamin E", "Vitamin D", "Vitamin K", "Saturated fat", "Monounsaturated fat", "Polyunsaturated fat", "Trans fat", "Cholesterol", "Caffeine"};

void fillMap() {
  units["Calories"] = "kcal";
  units["Protein"] = "g";
  units["Fat"] = "g";
  units["Carbohydrates"] = "g";
  units["Fiber"] = "g";
  units["Sugars"] = "g";
  units["Calcium"] = "mg";
  units["Iron"] = "mg";
  units["Magnesium"] = "mg";
  units["Phosphorus"] = "mg";
  units["Potassium"] = "mg";
  units["Sodium"] = "mg";
  units["Zinc"] = "mg";
  units["Vitamin C"] = "mg";
  units["Thiamin"] = "mg";
  units["Riboflavin"] = "mg";
  units["Niacin"] = "mg";
  units["Vitamin B-6"] = "mg";
  units["Folate"] = "µg";
  units["Vitamin B-12"] = "µg";
  units["Vitamin A"] = "IU";
  units["Vitamin E"] = "mg";
  units["Vitamin D"] = "IU";
  units["Vitamin K"] = "µg";
  units["Saturated fat"] = "g";
  units["Monounsaturated fat"] = "g";
  units["Polyunsaturated fat"] = "g";
  units["Trans fat"] = "g";
  units["Cholesterol"] = "mg";
  units["Caffeine"] = "mg";
}

struct info {
  string name;
  map<string, string> values;
};

vector<info> des;

int main() {
  fillMap();
  string s;
  
/*
  // gets the units map
  while (getline(cin, s)) {
		string k = s.substr(0, s.find(":"));
		s = s.substr(s.find(":") + 2);
		s = s.substr(s.find(" ") + 1); 
		//cout << "units[\"" << k << "\"] = " << "\"" << s << "\";" << "\n";
		//cout << "\"" << k << "\", ";
  }
*/
/*
	// get names
  while (getline(cin, s)) {
    if (!s.find("Name:")) {
      cout << s.substr(6) << "\n";
    }
  }
*/

  vector<string> lines;
  
	while (getline(cin, s)) 
		lines.push_back(s);
	
	int i = 0;
	while (i < lines.size()) {
		info temp;
		temp.name = lines[i++].substr(lines[i].find(":") + 2);
		while (!lines[i].empty()) {
			string k = lines[i].substr(0, lines[i].find(":"));
			string r = lines[i].substr(lines[i].find(":") + 2);
			r = r.substr(0, r.find(" "));
			
			temp.values[k] = r;
			
			//cout << k << " " << r << "\n";
			/*
			if (units[k] != r)
				cout << temp.name << "\n";
			*/
			++i;
		}
		
		des.push_back(temp);		
		++i;
	}
	
	for (int j = 0; j < des.size(); ++j) {
		info temp = des[j];
		map<string, string> val = temp.values;
		
		cout << "INSERT INTO `Fruits`(`Name`, ";
		auto iter = val.begin();
		++iter;
		for (auto it = val.begin(); it != val.end(); ++it, ++iter) {
			if (iter != val.end())
				cout << "`" << it -> first << "`, ";
			else cout << "`" << it -> first << "`"; 
		}
		cout << ") VALUES(\'" << temp.name.erase(temp.name.find_last_not_of(" \n\r\t")+1) << "\', ";				// gets rid of extra whitespace
		auto iter2 = val.begin();
		++iter2;
		for (auto it = val.begin(); it != val.end(); ++it, ++iter2) {
			if (iter2 != val.end())
				cout << "\'" << it -> second << "\', ";
			else cout << "\'" << it -> second << "\'"; 
		}
		cout << ");\n";
	}	

  return 0;
}
