import re

line = "250500 КАРЬЕР, ШОРООН ОРД НЭЭХ, НӨХӨН СЭРГЭЭХ АЖИЛ 25-05-01 Шороон орд нээх Хэмжих нэгж: 100 м3"

import pandas as pd
import re

df = pd.read_excel("25 zadargaa eb.xlsx")
df.columns = ["col1", "col2", "col3", "col4"]

codes = []
descriptions = []
units = []
valid_numbers = [str(i) for i in range(1, 20)]
i = 0
all_tuples = []
j = 0
while j < len(df):
            print("1")
            check_valid_numbers = str(df["col4"][j])

            print("iterate", check_valid_numbers)
            # Skip until the first valid number
            if not check_valid_numbers.startswith("1"):
                    j += 1
                    continue
            print("2")
            while j < len(df) and str(df["col4"][j]).startswith(tuple(valid_numbers)):
                match = re.search(r'(\d+-\d+-\d+)$', str(df["col4"][j]))
                testing = match.group(1)
                print(testing)
                j += 1
m = re.match(r"(\d{2}-\d{2}-\d{2})\s+(.*?)\s+(Хэмжих нэгж.*)", combined_val)
if m:
    new_list = [''] * 25
    new_list[0] = m.group(1).replace("-", "")
    new_list[1] = m.group(2)
    new_list[2] = m.group(3)
else:
    # try second pattern if first failed
    m = re.match(r"(\d{6})\s+(.*?)\s+(Хэмжих нэгж.*)", combined_val)
    if m:
        new_list = [''] * 25
        new_list[0] = m.group(1)  # already 6 digits, no need to replace "-"
        new_list[1] = m.group(2)
        new_list[2] = m.group(3)

            


