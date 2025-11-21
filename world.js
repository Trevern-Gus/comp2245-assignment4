document.addEventListener("DOMContentLoaded", () => {
  const lookupBtn = document.getElementById("lookup");
  const resultDiv = document.getElementById("result");
  const countryInput = document.getElementById("country");

  lookupBtn.addEventListener("click", () => {
    const country = countryInput.value.trim();
    
    let url = `world.php?country=${encodeURIComponent(country)}`;

    fetch(url)
      .then(response => response.text())
      .then(data => {
        resultDiv.innerHTML = data; // Display results
      })
      .catch(error => {
        resultDiv.innerHTML = `<p style="color:red;">Error: ${error}</p>`;
      });
  });
});