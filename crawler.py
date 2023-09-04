import asyncio
from pyrogram import Client
from pyrogram.errors import FloodWait
import nest_asyncio
import json
import pandas as pd
import sqlite3
import requests

# Allow running an event loop within a Jupyter notebook or IPython shell
nest_asyncio.apply()

token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJwbGFuIjoibm9ybWFsIiwiY3JlYXRlZERhdGUiOiIyMDIzLTA0LTA5VDA4OjQyOjEyLjk3N1oiLCJ1c2VySWQiOiIxMTEiLCJkdXJhdGlvbiI6OTAsImV4cGlyZURhdGUiOiIyMDIzLTA3LTA4VDA4OjQyOjEyLjk3N1oiLCJtYXhSZXF1ZXN0UGVyRGF5IjoidW5saW1pdGVkIiwibWF4UmVxdWVzdFBlck1vbnRoIjoidW5saW1pdGVkIiwiY29zdFBlclJlcXVlc3QiOjUwLCJjb3N0UGVyTW9udGgiOjAsImlhdCI6MTY4MTAyOTczM30._Klx52YY2ypSs-cw43PGYe5KPbgoBzq5zuUgy6Cq5h8'
api_id = 20094984
api_hash = '99df5bd55bc44d3627eb1dffb0517aea'
TARGET = input("Enter a channel id: ")

app = Client("my_account", api_id=api_id, api_hash=api_hash)
data = []

def emotion(text):
  headers = {
    'Authorization': f'Bearer {token}'
  }
  # API endpoint
  url = 'https://ai.aradcloud.ir/emotionRecognition/'
  # Make the API request
  response = requests.post(url, headers=headers, text=text)
  # Check if the request was successful
  if response.status_code == 200:
    # Parse the JSON response
    data = response.json()

    # Extract emotions from the response
    emotions = data['emotions']

    # Now, you can add the emotions data to your database in JSON format
    # Use your database library to insert the data
  else:
    print(f'Error: {response.status_code} - {response.text}')

async def main():
    async with app:
        # Create a connection to the SQLite database
        conn = sqlite3.connect('output.sql')

        # Create a cursor object
        c = conn.cursor()

        # Create a table to store the messages
        c.execute('''CREATE TABLE IF NOT EXISTS messages
                     (id INTEGER PRIMARY KEY,
                      text TEXT,
                      date TEXT,
                      views INTEGER,
                      reaction JSON)''')

        # Retrieve the chat history
        messages = app.get_chat_history(TARGET,10)
        print(messages)
        # Iterate through the messages and insert each one into the table
        async for message in app.get_chat_history(TARGET,10):
            allstuff=(await app.get_messages(TARGET, message.id))
            allstuff=json.loads(str(allstuff))
            print(allstuff['id'])
            emotion(allstuff['text'])
            emojis=allstuff['reactions']['reactions']
            reaction=""
            for item in emojis:
              print('{"emoji":'+'"'+item["emoji"]+'"'+','+'"count":'+str(item["count"])+'}')
              reaction+='{"emoji":'+'"'+item["emoji"]+'"'+','+'"count":'+str(item["count"])+'},'
            c.execute("INSERT INTO messages (id, text, date, views, reaction) VALUES (?, ?, ?, ?, ?)",
                      (message.id, message.text, message.date,message.views, reaction))
        # Commit the changes to the database
        print(type(reaction))
        conn.commit()
        i=0
        for item in emojis:
          item=c.execute("SELECT reaction FROM messages").fetchall()
          print(item)
        # Close the connection
        conn.close()

nest_asyncio.apply()
app.run(main())
