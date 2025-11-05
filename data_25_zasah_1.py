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

    # Skip 6-digit header rows like 251500 ...
    if re.match(r"25\d{4}\s", val):
        i += 1
        continue
    
    # If line starts with 25XX00, extract the 25-XX-XX part
    if re.match(r"^25\d{2}00", val):
        print("250000", val)
        match = re.match(r"25\d{2}00.*?(25-\d{2}-\d{2}.*)", val)
        if match:
            val = match.group(1)

    # Only process rows starting with 25-xx-xx
    if val.startswith("25") and re.match(r"25-\d{2}-\d{2}", val):
        combined_val = val
        j = i + 1

        # Merge next rows if 'Хэмжих нэгж' is on the next row
        while "Хэмжих нэгж" not in combined_val and j < len(df):
            combined_val += " " + str(df["col4"][j])
            j += 1

        # Apply regex
        m = re.match(r"(\d{2}-\d{2}-\d{2})\s+(.*?)\s+(Хэмжих нэгж.*)", combined_val)
        if m:
            codes.append(m.group(1).replace("-", ""))
            descriptions.append(m.group(2))
            units.append(m.group(3))
        i = j
    else:
        i += 1

# Create result DataFrame
df_result = pd.DataFrame({
    "code": codes,
    "description": descriptions,
    "unit": units
})

# Write to text file
text_lines = df_result.apply(lambda row: f"{row['code']} {row['description']} {row['unit']}", axis=1)
text_output = "\n".join(text_lines)

with open("25_output.txt", "w", encoding="utf-8") as f:
    f.write(text_output)

print("Text file '25_output.txt' written successfully!")
