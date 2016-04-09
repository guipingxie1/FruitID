#include <bits/stdc++.h>
using namespace std;

vector< string > links;

int main() {
	string line;
	
	while ( getline(cin, line) ) {
		if ( find(links.begin(), links.end(), line) == links.end() ) 
			links.push_back( line );
	}
	
	for ( int i = 0; i < links.size(); ++i ) 
		cout << links[i] << "\n";
		
	return 0;
}
