const form = document.getElementById("contact-form");
const canvas = document.getElementById("captcha-canvas");
const ctx = canvas.getContext("2d");
const input = document.getElementById("captcha-input");
const confirmation = document.getElementById("confirmation-message");

let captchaCode = "";

function generateCaptcha() {
  captchaCode = "";
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789";
  for (let i = 0; i < 5; i++) {
    const char = chars.charAt(Math.floor(Math.random() * chars.length));
    captchaCode += char;

    ctx.font = "24px Arial";
    ctx.fillStyle = `rgb(${Math.random()*100}, ${Math.random()*100}, ${Math.random()*100})`;
    ctx.fillText(char, 25 * i + 5, 35);
  }
}
generateCaptcha();

form.addEventListener("submit", (e) => {
  e.preventDefault();

  if (input.value.toUpperCase() !== captchaCode) {
    alert("Incorrect CAPTCHA. Please try again.");
    input.value = "";
    generateCaptcha();
    return;
  }

  form.style.display = "none";
  confirmation.style.display = "block";
});
