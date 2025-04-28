## WORKS WITH OXYLABS API
# This script sends a POST request to the Oxylabs API to get trending summer clothes data.


import requests
from pprint import pprint

# Structure payload with a query parameter for trending summer clothes.
payload = {
    'source': 'google_search',  # Specify the source
    'query': 'trending summer clothes',  # Update the query to search for summer clothes
    'geo_location': 'California,United States',  # Optional: Specify location
    'parse': True  # Optional: Enable parsing for structured data
}

# Get response.
response = requests.request(
    'POST',
    'https://realtime.oxylabs.io/v1/queries',
    auth=('idk12_EkUHh', 'xazpyp_2wyvwErogpiq'),  # Your credentials go here
    json=payload,
)

# Print the JSON response.
pprint(response.json())