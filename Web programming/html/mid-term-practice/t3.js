const input = document.querySelector("input");

function handleKeyDown(event) {
  if (event.code === "Backspace" || event.code === "Delete") {
    event.preventDefault();
    return;
  }

  const allowedChars = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "."];
  if (!allowedChars.includes(event.key)) {
    event.preventDefault();
    return;
  }

  const ipAddress = input.value + event.key;
  const parts = ipAddress.split(".");
 
  if (parts.length < 4) {
    input.classList.remove("correct");
    input.classList.add("incorrect");
    return;
  }

  if (parts.every(part => parseInt(part) >= 0 && parseInt(part) <= 255)){
    input.classList.add("correct");
    input.classList.remove(".incorrect");
  } else {
    input.classList.remove("correct");
    input.classList.add(".incorrect");
  }
}

input.addEventListener("keydown", handleKeyDown);