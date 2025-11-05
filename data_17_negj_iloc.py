import pandas as pd
import re
# Load Excel
df = pd.read_excel("17 zadargaa zassan.xlsx")
df["Unnamed: 1"] = df["Unnamed: 1"].astype(str).str.replace("-", "", regex=False)
df = df.reset_index(drop=True)
valid_numbers = [str(i) for i in range(1, 20)]
all_tuples = []  # to store multiple rows
results = []
i = 0
while i < len(df):
    print("first_loop", i)
    if df["Unnamed: 4"].iloc[i] == 'К':  # use iloc[i]
        negj = str(df["Unnamed: 3"].iloc[i])
        match = re.search(r"Код:\s*(\S+).*?(\d+)\s*(\S+)", negj)
        if match:
            _, last_number, last_unit = match.groups()
            results.append((last_number, last_unit))
        i += 1
    elif df["Unnamed: 4"].iloc[i] == 'Н':
        print("second_loop", i)
        cell_value = df["Unnamed: 3"].iloc[i]
        if isinstance(cell_value, str) and "Нэр" in cell_value:
            new_list = [''] * 20
            new_list[0] = df["Unnamed: 1"].iloc[i]
            new_list[1] = cell_value.replace("Нэр:", "").strip()
            new_list[2] = last_number
            new_list[3] = last_unit
            j = i + 1
            tuple_index = 4
            while j < len(df):
                print("third_loop", i, "and", j)
                check_valid_numbers = str(df["Unnamed: 4"].iloc[j])
                if check_valid_numbers not in valid_numbers:
                    j += 1
                    continue #skip the below loop when not in is true
                while j < len(df) and str(df["Unnamed: 4"].iloc[j]) in valid_numbers:
                    print("fourth_loop", i , "and", j)
                    new_list[tuple_index] = re.sub(r'^\d+\.?\s*', '', str(df["Unnamed: 3"].iloc[j]))
                    tuple_index += 1
                    j += 1
                break
            all_tuples.append(tuple(new_list))
            print("last_loop", j, "and", i)
        i += 1
    else:
        i += 1
