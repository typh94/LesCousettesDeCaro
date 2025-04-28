# from pytrends.request import TrendReq
# import pandas as pd
# import matplotlib.pyplot as plt
# # Initialize a Google Trends session
# pytrends = TrendReq(hl='en-US', tz=360)
# # Define search terms
# keywords = ["women skirt", "women dress", "women pants"]
# # Build payload
# pytrends.build_payload(kw_list=keywords, timeframe='today 12-m', geo='US')
# # Fetch interest over time
# interest_over_time_df = pytrends.interest_over_time()
# # Display the data
# print(interest_over_time_df.head())
# # Plotting the interest over time
# interest_over_time_df.plot(figsize=(10, 6))
# plt.title('Google Trends Over Time')
# plt.xlabel('Date')
# plt.ylabel('Interest Level')
# plt.grid()
# plt.show()

from pytrends.request import TrendReq
import pandas as pd
import matplotlib.pyplot as plt

# Initialize a Google Trends session
pytrends = TrendReq(hl='en-US', tz=360)

# Define search terms
keywords = ["skirt", "dress", "women pants", "women shirt"]

 # Combine all keywords
# Build payload
pytrends.build_payload(kw_list=keywords, timeframe='today 12-m', geo='US')

# Fetch interest over time
interest_over_time_df = pytrends.interest_over_time()

# Display the data
print(interest_over_time_df.head())

# Plotting the interest over time and saving the graph as an image
plt.figure(figsize=(10, 6))
interest_over_time_df.plot()
plt.title('Google Trends Over Time')
plt.xlabel('Date')
plt.ylabel('Interest Level')
plt.grid()
plt.savefig('/Applications/XAMPP/xamppfiles/htdocs/LesCousettesDeCaro/trends_graph.png')  # Save the graph
plt.close()  # Close the plot to avoid display issues


