import pandas as pd
df = pd.read_excel("Book7.xlsx")
df_2 = pd.read_excel("25.xlsx")


for col in df.columns:
    df[col] = df[col].astype(str).str.replace("-","")

for col in df_2.columns:
    df_2[col] = df_2[col].astype(str).str.replace("-","")

df_2.columns = ['A', 'B']
df_2_mapping = df_2.groupby('A')['B'].first().to_dict()

num_columns = 22  # total columns in final output
result = []

for group_name, group_df in df.groupby('code 1'):
    values = group_df['code 2'].tolist()        # get all values for this group
    row = [group_name, 'null']             # first two columns

    second_col = df_2_mapping.get(group_name, values[0] if len(values) > 0 else 'null')
    row = [group_name, second_col]
    row.extend(values)                     # add B values
    # pad with 'null' to make 22 columns
    while len(row) < num_columns:
        row.append('null')
    result.append(tuple(row))

with open("buleg.txt", "w", encoding="utf-8") as file:
    for r in result:
        row_str = "(" + ", ".join(f"'{val}'" for val in r) + "),"
        file.write(row_str + "\n")

# Print result

for r in result:
    print(r)