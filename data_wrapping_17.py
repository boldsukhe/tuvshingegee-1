import pandas as pd
import re
# Load Excel
df = pd.read_excel("17 zadargaa eb.xlsx")
df["Unnamed: 1"] = df["Unnamed: 1"].astype(str).str.replace("-", "", regex=False)
valid_numbers = [str(i) for i in range(1, 20)]
all_tuples = []  # to store multiple rows

i = 0
while i < len(df):

  
    if df["Unnamed: 4"][i] == 'Н':
        cell_value = str(df["Unnamed: 3"][i])

        # If sentence contains "Нэр", start a new row
        if "Нэр" in cell_value:
            new_list = [''] * 20  # fresh row
            new_list[0] = df["Unnamed: 1"][i]  # first column
            new_list[1] = cell_value           # second column
            new_list[1] = str(new_list[1]).replace("Нэр:", "").strip()
            # Start scanning forward for consecutive valid numbers
            j = i + 1
            tuple_index = 2

            while j < len(df):
                check_valid_numbers = str(df["Unnamed: 4"][j])

                # Skip until the first valid number
                if check_valid_numbers not in valid_numbers:
                    j += 1
                    continue
                
                    

                # Collect consecutive valid numbers
                while j < len(df) and str(df["Unnamed: 4"][j]) in valid_numbers:
                    new_list[tuple_index] = re.sub(r'^\d+\.?\s*', '', df["Unnamed: 3"][j])
                    tuple_index += 1
                    j += 1

                # Finished this block, break to save row
                break

            all_tuples.append(tuple(new_list))  # save completed row
            i = j  # continue outer loop from after this block
        else:
            i += 1
    else:
        i += 1

# all_tuples now contains multiple 20-length tuples
formatted = ",".join(str(t) for t in all_tuples)
print(len(formatted))
with open("17_formatted.txt", "w", encoding="utf-8") as f:
    for t in all_tuples:
        f.write(f"{t},\n")