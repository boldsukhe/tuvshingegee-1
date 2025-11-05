import pandas as pd
import re

df = pd.read_excel("25 zadargaa eb.xlsx")
df.columns = ["col1", "col2", "col3", "col4"]

codes = []
descriptions = []
units = []

i = 0
while i < len(df):
    val = str(df["col4"][i])
    
    if val.startswith("25"):
        combined_val = val
        
        # look ahead until 'Хэмжих нэгж' is found
        j = i + 1
        while "Хэмжих нэгж" not in combined_val and j < len(df):  # Sometimes "Хэмжих нэгж" is in next row
            combined_val += " " + str(df["col4"][j])
            j += 1
        
        # apply regex
        m = re.match(r"(\d{2}-\d{2}-\d{2})\s+(.*?)\s+(Хэмжих нэгж.*)", combined_val)
        if m:
            codes.append(m.group(1).replace("-", ""))
            descriptions.append(m.group(2))
            units.append(m.group(3))
        
        i = j  # skip merged rows
    else:
        i += 1

# Build DataFrame from lists
df_result = pd.DataFrame({
    "code": codes,
    "description": descriptions,
    "unit": units
})

# Convert to text lines
text_lines = df_result.apply(lambda row: f"{row['code']} {row['description']} {row['unit']}", axis=1)

# Join lines into a single string
text_output = "\n".join(text_lines)

# Write to a text file
with open("25_output.txt", "w", encoding="utf-8") as f:
    f.write(text_output)

print("Text file '25_output.txt' written successfully!")
