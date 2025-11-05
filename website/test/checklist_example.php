<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dynamic Checkboxes</title>
</head>
<body>

<div id="container"></div>

<script>
const data = [
  { id: 1, name: "Item 1" },
  { id: 2, name: "Item 2" },
  { id: 3, name: "Item 3" }
];

function getCheckboxValue(id) {
  const checkbox = document.getElementById(`myCheckbox_${id}`);
  alert(`${data.find(item => item.id === id).name}: ${checkbox.checked}`);
}

if (data.length > 0) {
  const container = document.getElementById("container");
  
  data.forEach(item => {
    // Create checkbox
    const checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.id = `myCheckbox_${item.id}`;

    // Create label
    const label = document.createElement("label");
    label.htmlFor = checkbox.id;
    label.textContent = item.name + " ";

    // Create button
    const button = document.createElement("button");
    button.textContent = "Get Value";
    button.onclick = () => getCheckboxValue(item.id);

    // Append to container
    container.appendChild(label);
    container.appendChild(checkbox);
    container.appendChild(button);
    container.appendChild(document.createElement("br"));
  });
}
</script>

</body>
</html>
