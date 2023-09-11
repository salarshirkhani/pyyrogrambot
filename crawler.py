# fetching data with db connection and uploads
import asyncio
from pyrogram import Client
from pyrogram.errors import FloodWait
import nest_asyncio
import json
import pandas as pd
import sqlite3
import requests
import ast

nest_asyncio.apply()

api_id = 20094984
api_hash = '99df5bd55bc44d3627eb1dffb0517aea'
TARGET = "qomstu"

app = Client("my_account", api_id=api_id, api_hash=api_hash)
data = []

async def emotion(text):
  try:
      response = requests.post(
      'https://ai.aradcloud.ir/emotionRecognition/',
      json={"text":text},
      headers={"Accept-encoding":"json","Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJwbGFuIjoibm9ybWFsIiwiY3JlYXRlZERhdGUiOiIyMDIzLTA0LTA5VDA4OjQyOjEyLjk3N1oiLCJ1c2VySWQiOiIxMTEiLCJkdXJhdGlvbiI6OTAsImV4cGlyZURhdGUiOiIyMDIzLTA3LTA4VDA4OjQyOjEyLjk3N1oiLCJtYXhSZXF1ZXN0UGVyRGF5IjoidW5saW1pdGVkIiwibWF4UmVxdWVzdFBlck1vbnRoIjoidW5saW1pdGVkIiwiY29zdFBlclJlcXVlc3QiOjUwLCJjb3N0UGVyTW9udGgiOjAsImlhdCI6MTY4MTAyOTczM30._Klx52YY2ypSs-cw43PGYe5KPbgoBzq5zuUgy6Cq5h8","Content-type":"application/json"})
  except Exception as e:
      print(f"An error occurred: {e}")
  return response.text

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
                      reaction JSON,
                      emotion JSON)''')

        # Retrieve the chat history
        messages = app.get_chat_history(TARGET,10)
        # Iterate through the messages and insert each one into the table
        async for message in app.get_chat_history(TARGET,10):
            allstuff=(await app.get_messages(TARGET, message.id))
            allstuff=json.loads(str(allstuff))
            emojis=allstuff['reactions']['reactions']
            reaction=""
            for item in emojis:
              reaction+='"'+item["emoji"]+'":'+str(item["count"])+','
            reaction=reaction[:len(reaction)-1]
            reaction="{"+reaction+"}"
            print(reaction)
            emo = asyncio.run(emotion(message.text))
            c.execute("INSERT INTO messages (id, text, date, views, reaction, emotion) VALUES (?, ?, ?, ?, ?, ?)",
                      (message.id, message.text, message.date,message.views, reaction , emo))
        # Commit the changes to the database
        conn.commit()
        reactdb=[]
        for item in range(len(emojis)):
          reactdb.append(c.execute("SELECT reaction FROM messages").fetchall()[item][0])
          reactdb[item]=json.loads(reactdb[item])
          print(type(reactdb[item]))
          print(reactdb[item])
        # Close the connection
        conn.close()

nest_asyncio.apply()
app.run(main())
