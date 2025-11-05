
import pandas as pd
import re

df = pd.read_excel("25 zadargaa eb.xlsx")
df.columns = ["col1", "col2", "col3", "col4"]
i = 0
while i < len(df):
    i += 1
with open("check_i.txt", "w", encoding="utf-8") as f:
    f.write(str(i))
z = j
while "Хэмжих нэгж" not in combined_val and z < len(df):  # Sometimes "Хэмжих нэгж" is in next row
        z += 1
        while "Хэмжих нэгж" not in str(df["col4"][z]) and z < len(df):
            z += 1
        unit_match = re.search(r"(Хэмжих нэгж.*)$", combined_val)
        if unit_match:
            clean_unit = unit_match.group(1)
        break
