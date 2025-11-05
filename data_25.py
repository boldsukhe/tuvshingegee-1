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
while i < len(df):
    val = str(df["col4"][i])
    
    if val.startswith("25"):
        combined_val = val
        
        # look ahead until 'Хэмжих нэгж' is found
        j = i 
        #while "Хэмжих нэгж" not in combined_val and j < len(df):  # Sometimes "Хэмжих нэгж" is in next row
            
        #    combined_val += " " + str(df["col4"][j])
        #    j += 1
        z = j
        clean_unit = ""
        #############################
        if "Хэмжих нэгж" not in combined_val:
        # loop until we find a row with "Хэмжих нэгж" or reach the end
            while z < len(df):
                row_val = str(df["col4"][z])
                if "Хэмжих нэгж" in row_val:
                    # extract from Хэмжих нэгж to the end
                    unit_match = re.search(r"(Хэмжих нэгж.*)$", row_val)
                    if unit_match:
                        clean_unit = unit_match.group(1)
                        combined_val += " " + clean_unit
                    break
                z += 1
       
        j = z
        #
        # apply regex
        m = re.match(r"(\d{2}-\d{2}-\d{2})\s+(.*?)\s+(Хэмжих нэгж.*)", combined_val)
        if m:
            new_list = [''] *25
            new_list[0] = (m.group(1).replace("-", "")) # Dugaar
            new_list[1] = (m.group(2)) # Utga
            new_list[2] = (m.group(3).replace("Хэмжих нэгж", "").strip()) # Negj
            #new_list[2] = clean_unit.replace("Хэмжих нэгж", "").strip()
            tuple_index = 3
        else:
    # try second pattern if first failed
            m = re.match(r"(\d{6})\s+(.*?)\s+(Хэмжих нэгж.*)", combined_val)
            if m:
                new_list = [''] * 25
                new_list[0] = m.group(1)  # already 6 digits, no need to replace "-"
                new_list[1] = m.group(2)
                new_list[2] = m.group(3)
                #new_list[2] = clean_unit.replace("Хэмжих нэгж", "").strip()
                tuple_index = 3
            ###############################################
        while j < len(df):
            check_valid_numbers = str(df["col4"][j])

            # Skip until the first valid number
            if not check_valid_numbers.startswith("1"):
                j += 1
                continue
            while j < len(df) and str(df["col4"][j]).startswith(tuple(valid_numbers)):
                #if tuple_index > 23:
                #    print("error at:", new_list[0])
                print(f"i={i}, j={j}, tuple_index={tuple_index}, value={df['col4'][j]}", flush=True)
                match = re.search(r'(\d+-\d+-\d+)$', str(df["col4"][j]))
                new_list[tuple_index] = match.group(1)
                tuple_index += 1
                j += 1
            break
                ################################
                #while str(df["col4"][j]).startswith(valid_numbers) and j < len(df):
                #    new_list[tuple_index] = re.sub(r'.*?(\d+-\d+-\d+-\d+)$', r'\1', df["col4"][j])
                #    tuple_index += 1
                #    j += 1
                #break
        all_tuples.append(tuple(new_list))  # save completed row
        i = j  # continue outer loop from after this block
    else:
        i += 1


formatted = ",".join(str(t) for t in all_tuples)
print(len(formatted))
with open("25_formatted.txt", "w", encoding="utf-8") as f:
    for t in all_tuples:
        f.write(f"{t},\n")
print("success")