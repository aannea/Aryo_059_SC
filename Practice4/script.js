document.addEventListener("DOMContentLoaded", function () {
  const generateButton = document.getElementById("generateButton");
  const shuffleAgainButton = document.getElementById("shuffleAgainButton");
  const resetButton = document.getElementById("resetButton");
  const namesInput = document.getElementById("names");
  const groupCountInput = document.getElementById("groupCount");
  const resultDiv = document.getElementById("result");
  let originalNames = [];

  generateButton.addEventListener("click", function () {
    originalNames = namesInput.value.split("\n").map((name) => name.trim());
    const groupCount = parseInt(groupCountInput.value, 10);

    if (originalNames.length > 0 && groupCount > 0) {
      const groups = divideIntoGroups(originalNames, groupCount);
      displayResult(groups);
      showShuffleAgainButton();
      showResetButton();
    } else {
      resultDiv.textContent = "Masukkan nama-nama dan jumlah kelompok terlebih dahulu.";
    }
  });

  shuffleAgainButton.addEventListener("click", function () {
    if (originalNames.length > 0) {
      const groupCount = parseInt(groupCountInput.value, 10);
      const shuffledNames = shuffleArray(originalNames);
      const groups = divideIntoGroups(shuffledNames, groupCount);
      displayResult(groups);
    }
  });

  resetButton.addEventListener("click", function () {
    namesInput.value = "";
    resultDiv.innerHTML = "";
    hideShuffleAgainButton();
    hideResetButton();
    originalNames = [];
  });

  function divideIntoGroups(names, groupCount) {
    const groups = [];
    for (let i = 0; i < groupCount; i++) {
      groups.push([]);
    }

    for (let i = 0; i < names.length; i++) {
      const groupName = i % groupCount;
      groups[groupName].push(names[i]);
    }

    return groups;
  }

  function displayResult(groups) {
    resultDiv.innerHTML = "";
    groups.forEach((group, index) => {
      const groupHeading = document.createElement("h3");
      groupHeading.textContent = `Kelompok ${index + 1}:`;
      resultDiv.appendChild(groupHeading);

      const groupList = document.createElement("ul");
      group.forEach((name) => {
        const listItem = document.createElement("li");
        listItem.textContent = name;
        groupList.appendChild(listItem);
      });
      resultDiv.appendChild(groupList);
    });
  }

  function showShuffleAgainButton() {
    shuffleAgainButton.classList.remove("hidden");
  }

  function hideShuffleAgainButton() {
    shuffleAgainButton.classList.add("hidden");
  }

  function showResetButton() {
    resetButton.classList.remove("hidden");
  }

  function hideResetButton() {
    resetButton.classList.add("hidden");
  }

  function shuffleArray(array) {
    const shuffledArray = [...array];
    for (let i = shuffledArray.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [shuffledArray[i], shuffledArray[j]] = [shuffledArray[j], shuffledArray[i]];
    }
    return shuffledArray;
  }
});
