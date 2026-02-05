function askAI() {
  let text = document.getElementById("userInput").value;

  fetch("api.php", {
    method: "POST",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({prompt: text})
  })
  .then(res => res.json())
  .then(data => {
    document.getElementById("output").innerHTML = data.reply;
  });
}
