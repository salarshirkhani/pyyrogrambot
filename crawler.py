import asyncio
from pyrogram import Client
from pyrogram.errors import FloodWait
import nest_asyncio
import json
import pandas as pd

api_id = 20094984
api_hash = '99df5bd55bc44d3627eb1dffb0517aea'
TARGET = input("Enter a channel id: ")

app = Client("my_account", api_id=api_id, api_hash=api_hash)
data = []

async def main():
    async with app:

        async for message in app.get_chat_history(TARGET,10):
          msg = await app.get_messages(TARGET, message.id)
          print(await app.get_messages(TARGET, message.id))
          # Convert the messages to a pandas DataFrame
          data.append([msg.sender_chat.title,msg.sender_chat.username,message.id, msg.caption, message.date,message.views,msg.forwards])
          df = pd.DataFrame(data, columns=["channel_name","channel_id","Message ID", "Text", "Date","view" ,"forward" ])
          # Save the DataFrame to an Excel file
          df.to_excel("output.xlsx", index=False)

nest_asyncio.apply()
app.run(main())