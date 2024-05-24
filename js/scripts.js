document.addEventListener("DOMContentLoaded", function () {
  fetchData("archer", "php/fetch_data.php?type=archers");
  fetchData("competition", "php/fetch_data.php?type=competitions");
  fetchData("round", "php/fetch_data.php?type=rounds");
  fetchData("division", "php/fetch_data.php?type=divisions");
  fetchData("class", "php/fetch_data.php?type=classes");
  fetchData("session", "php/fetch_data.php?type=sessions");
  fetchData("distance", "php/fetch_data.php?type=distances");
  fetchData("shootingRange", "php/fetch_data.php?type=shootingRanges");

  document
    .getElementById("endForm")
    .addEventListener("submit", function (event) {
      if (!validateScores()) {
        event.preventDefault();
      }
    });

  checkEndsNeeded();
});

function fetchData(elementId, url) {
  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      let select = document.getElementById(elementId);
      data.forEach((item) => {
        let option = document.createElement("option");
        option.value = item.value;
        option.textContent = item.text;
        select.appendChild(option);
      });
    })
    .catch((error) => console.error("Error fetching data:", error));
}

function validateScores() {
  let scores = [];
  for (let i = 1; i <= 6; i++) {
    let score = parseInt(document.getElementById("arrow" + i).value);
    if (!isNaN(score)) {
      scores.push(score);
    }
  }

  for (let i = 0; i < scores.length - 1; i++) {
    if (scores[i] < scores[i + 1]) {
      alert("Scores must be entered in descending order.");
      return false;
    }
  }
  return true;
}

function checkEndsNeeded() {
  fetch("php/check_ends.php")
    .then((response) => response.json())
    .then((data) => {
      if (!data.ends_needed) {
        alert("No more ends are needed for this session.");
        document.getElementById("endForm").style.display = "none";
      }
    })
    .catch((error) => console.error("Error checking ends:", error));
}
