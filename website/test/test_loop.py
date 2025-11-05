found = False
for i in range(3):
    for j in range(3):
        if i == 1 and j == 1:
            print(f"Condition met at i={i}, j={j}. Setting flag.")
            found = True
            break  # Exits inner loop
        print(f"Inner loop: i={i}, j={j}")
    if found:
        print(f"Flag is True. Breaking outer loop.")
        break  # Exits outer loop
    print("what if here loop")
    print(f"Outer loop continues: i={i}")