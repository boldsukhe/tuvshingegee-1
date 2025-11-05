import pandas as pd
import re
# Load Excel
df = pd.read_excel("17 zadargaa zassan.xlsx")
df["Unnamed: 1"] = df["Unnamed: 1"].astype(str).str.replace("-", "", regex=False)
valid_numbers = [str(i) for i in range(1, 20)]
all_tuples = []  # to store multiple rows
results = []
i = 0
print(len(df))
while i < len(df):
    shalgah = df["Unnamed: 4"][i]
    if df["Unnamed: 4"][i] == 'К':
        negj = str(df["Unnamed: 3"][i])
        match = re.search(r"Код:\s*(\S+).*?(\d+)\s*(\S+)", negj)
        if match:
            _, last_number, last_unit = match.groups()
            results.append((last_number, last_unit))
        i += 1
    elif df["Unnamed: 4"][i] == 'Н':
        cell_value = df["Unnamed: 3"][i]
        if isinstance(cell_value, str) and "Нэр" in cell_value:
            new_list = [''] * 20
            new_list[0] = df["Unnamed: 1"][i]
            new_list[1] = cell_value.replace("Нэр:", "").strip()
            new_list[2] = last_number
            new_list[3] = last_unit
            j = i + 1
            tuple_index = 4
            #print("loop_0", j)
            while j < len(df):
                print("outer_loop", j)
                check_valid_numbers = str(df["Unnamed: 4"][j])
                if check_valid_numbers not in valid_numbers:
                    j += 1
                    continue
                while j < len(df) and str(df["Unnamed: 4"][j]) in valid_numbers:
                    # strip leading number + dot if present
                    new_list[tuple_index] = re.sub(r'^\d+\.?\s*', '', str(df["Unnamed: 3"][j]))
                    tuple_index += 1
                    j += 1
                    print("inner_loop", j)
                print("what if here is break")  
                break

            all_tuples.append(tuple(new_list))  # save as tuple

        i += 1

    else:
        i += 1

formatted = ",".join(str(t) for t in all_tuples)
print(len(formatted))
with open("17_formatted_negj_2.txt", "w", encoding="utf-8") as f:
    for t in all_tuples:
        f.write(f"{t},\n")




