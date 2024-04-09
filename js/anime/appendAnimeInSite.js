async function appendAnimeInSite(data) {
  sessionStorage.removeItem("CurrentAnime");
  data = JSON.stringify(data);
  sessionStorage.setItem("CurrentAnime", data);
  window.myData = data;
  await main();
}

async function main() {
  const storedData = sessionStorage.getItem("CurrentAnime");
  if (storedData) {
    const _ANIME_ID_ = JSON.parse(storedData)[0].id;
    const _ANIME_JAPANESE_NAME = JSON.parse(storedData)[0].japanese;
    const _ANIME_ENGLISH_NAME_ = JSON.parse(storedData)[0].english;
    const _ANIME_RUSSIAN_NAME_ = JSON.parse(storedData)[0].russian;
    const _ANIME_IMAGE_ = JSON.parse(storedData)[0].poster.originalUrl;
    const _ANIME_AIR_YEAR_ = JSON.parse(storedData)[0].airedOn.year;
    const _ANIME_KIND_ = JSON.parse(storedData)[0].kind;
    const _ANIME_STATUS_ = JSON.parse(storedData)[0].status;
    const _ANIME_SCORE_ = JSON.parse(storedData)[0].score;
    const _ANIME_GENRES_ = JSON.parse(storedData)[0].genres;
    const _ANIME_DESCRIPTION_ = JSON.parse(storedData)[0].description;
    const _ANIME_SCREENSHOTS_ = JSON.parse(storedData)[0].screenshots;
    const _ANIME_CHARACTER_ROLES_ = JSON.parse(storedData)[0].characterRoles;
    // 1) append anime title
    document.title = `AnimeCO ${_ANIME_RUSSIAN_NAME_}`;

    // 2) append background image
    let background = document.querySelector(".anime-background");
    background.style.backgroundImage = `url(${_ANIME_IMAGE_})`;

    // 3) append anime image
    let animeImageBlock = document.querySelector(
      ".anime-back-global-info-image"
    );
    let appendAnimeImageBlock = `<img src="${_ANIME_IMAGE_}" alt="${_ANIME_ENGLISH_NAME_}">`;
    animeImageBlock.insertAdjacentHTML("beforeend", appendAnimeImageBlock);

    // 4) append anime names in eng and japance
    let animeNameEngJpg = document.querySelector(".anime-eng-jpg-name");
    let appendAnimeNameEngJpg = `<p>${_ANIME_ENGLISH_NAME_}  /  ${_ANIME_JAPANESE_NAME}</p><p>${_ANIME_AIR_YEAR_} . ${_ANIME_KIND_} . ${_ANIME_STATUS_} </p>`;
    animeNameEngJpg.insertAdjacentHTML("beforeend", appendAnimeNameEngJpg);
    animeNameEngJpg.style.cssText = "background: transparent !important;";

    // 5) append anime Name
    let animeName = document.querySelector(".anime-title-h2");
    let appendAnimeName = `<h2>${_ANIME_RUSSIAN_NAME_}</h2>`;
    animeName.insertAdjacentHTML("beforeend", appendAnimeName);
    animeName.style.cssText = "background: transparent !important;";

    // 6) appemd anime Score
    let animeScore = document.querySelector(".anime-score");
    let appendAnimeScore = `<p><i class="fa-solid fa-star"></i>${_ANIME_SCORE_}</p>`;
    animeScore.insertAdjacentHTML("beforeend", appendAnimeScore);
    animeScore.style.cssText = "background: transparent !important;";

    // 7) append anime genres
    let animeGenresList = document.querySelector(".anime-genres-list");
    const genres = _ANIME_GENRES_.map((genre) => genre.russian);
    const genresHTML = genres
      .map((genre) => `<a href="#">${genre}</a>`)
      .join("");
    let appendAnimeGenres = `${genresHTML}`;
    animeGenresList.insertAdjacentHTML("beforeend", appendAnimeGenres);
    animeGenresList.style.cssText = "background: transparent !important;";

    // 8) append anime about
    let animeAbout = document.querySelector(".anime-about");
    if (_ANIME_DESCRIPTION_ !== null) {
      const cleanedDescription = _ANIME_DESCRIPTION_.replace(/\[.*?\]/g, "");
      let appendAnimeAbout = `<p>${cleanedDescription}</p>`;
      animeAbout.insertAdjacentHTML("beforeend", appendAnimeAbout);
      animeAbout.style.cssText = "background: transparent !important;";
    } else {
      let appendAnimeAbout = `<p>Описание не доступно</p>`;
      animeAbout.insertAdjacentHTML("beforeend", appendAnimeAbout);
      animeAbout.style.cssText = "background: transparent !important;";
    }

    // 9) append anime stills
    let animeStillsContentList = document.querySelectorAll(
      ".anime-stills-content"
    );
    if (_ANIME_SCREENSHOTS_ && _ANIME_SCREENSHOTS_.length > 0) {
      animeStillsContentList.forEach((animeStillsContent, index) => {
        if (_ANIME_SCREENSHOTS_[index]) {
          const stillUrl = _ANIME_SCREENSHOTS_[index].originalUrl;
          animeStillsContent.insertAdjacentHTML(
            "beforeend",
            `<img src="${stillUrl}"></img>`
          );
        } else {
          console.warn(
            `No screenshot found for anime-stills-content ${index + 1}`
          );
        }
      });
    } else {
      console.warn("No screenshots found for this anime.");
    }

    // 10) append anime Characters
    async function createCharactersBlocks() {
      let animeCharacters = document.querySelectorAll(
        ".characters-list-container"
      );
      animeCharacters.forEach((element, index) => {
        let mainCharactersCount = 0;
        _ANIME_CHARACTER_ROLES_.forEach((characterRole) => {
          if (characterRole.rolesEn.includes("Main")) {
            mainCharactersCount++;
          }
        });
        mainCharactersCount--;
        for (let i = 0; i < mainCharactersCount; i++) {
          let newCharacterBlock = `
            <div class="character-content">
              <div class="character-content-image"></div>
              <p></p>
            </div>
          `;
          element.insertAdjacentHTML("beforeend", newCharacterBlock);
        }
      });
    }

    async function appendCharactersBlocks() {
      let characterBlocks = document.querySelectorAll(".character-content");
      characterBlocks.forEach((block, index) => {
        let character = _ANIME_CHARACTER_ROLES_[index];
        if (!character) return;
        let characterHTML = `
            <div class="character-content-image"><img src="${character.character.poster.originalUrl}" alt="${character.character.name}"></div>
            <p style="background: transparent !important;">${character.character.name}</p>
        `;
        block.innerHTML = characterHTML;
        // block.insertAdjacentHTML("beforeend", characterHTML);
      });
    }

    await createCharactersBlocks();
    await appendCharactersBlocks();
  } else {
    console.warn("No anime data found in sessionStorage.");
  }
}
