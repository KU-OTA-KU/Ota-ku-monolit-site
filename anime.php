<?php
if (isset($_GET['animeId'])) {
  $currentAnime = $_GET['animeId'];

  if (isset($_GET['voice'])) {
    $animeVoice = $_GET['voice'];
    echo "<script>let currentAnimeVoice = $animeVoice</script>";
  } else if (isset($_COOKIE['selectedVoice'])) {
    $animeVoice = $_COOKIE['selectedVoice'];
    echo "<script>let currentAnimeVoice = $animeVoice</script>";
  } else {
    $animeVoice = null;
    echo "<script>let currentAnimeVoice = $animeVoice</script>";
  }
  echo "<script>let currentAnime = $currentAnime;</script>";
  // echo $currentAnime;
} else {
  echo "get parametr id not defined!";
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XKSYJXXKPB"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-XKSYJXXKPB');
    </script>
    <!-- Yandex.RTB -->
    <script>window.yaContextCb = window.yaContextCb || []</script>
    <script src="https://yandex.ru/ads/system/context.js" async></script>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>OTA-KU Смотрть Аниме</title>
    <link rel="shortcut icon" href="assets/images/Ota-ku-logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="src/_root/root.css"/>
    <link rel="stylesheet" href="css/palette/dark_1.css"/>
    <link rel="stylesheet" href="css/scrollbar.css">

    <link rel="stylesheet" href="src/components/header/header.css"/>
    <link rel="stylesheet" href="src/components/animeHeader/animeHeader.css"/>
    <link rel="stylesheet" href="src/components/animeDescription/animeDescription.css"/>
    <link rel="stylesheet" href="src/components/stills/animeStills.css"/>
    <link rel="stylesheet" href="src/components/player/player.css"/>
    <link rel="stylesheet" href="src/components/banners/banners.css"/>
    <link rel="stylesheet" href="src/components/animeRelated/animeRelated.css"/>
    <link rel="stylesheet" href="src/components/charactersList/characters.css"/>
    <link rel="stylesheet" href="src/components/footer/footer.css"/>

    <link rel="stylesheet" href="src/_root/anime.css"/>
</head>

<body>
<!-- header Init Start -->
<?php include_once 'src/components/header/header.php'; ?>
<!-- header Init End -->
<!-- anime header Init Start -->
<?php include_once 'src/components/animeHeader/animeHeader.php'; ?>
<!-- anime header Init End -->
<!-- anime description start-->
<?php include_once "src/components/animeDescription/animeDescription.php"; ?>
<!-- anime description End-->
<!-- anime Stills Init Start -->
<?php include_once 'src/components/stills/animeStills.php'; ?>
<!-- anime Stills Init End -->
<section class="ban_1-container">
    <div class="ban_1-container-inner">
        <div class="ban_1-container-tit">
            <!-- Yandex.RTB R-A-7609325-4 -->
            <div id="yandex_rtb_R-A-7609325-4"></div>
            <script>
                window.yaContextCb.push(() => {
                    Ya.Context.AdvManager.render({
                        "blockId": "R-A-7609325-4",
                        "renderTo": "yandex_rtb_R-A-7609325-4"
                    })
                })
            </script>
        </div>
    </div>
</section>
<!-- anime player Init Start -->
<?php include_once 'src/components/player/player.php'; ?>
<!-- anime player Init End -->
<section class="ban_1-container">
    <div class="ban_1-container-inner">
        <div class="ban_1-container-tit">
            <!-- Yandex.RTB R-A-7609325-5 -->
            <div id="yandex_rtb_R-A-7609325-5"></div>
            <script>
                window.yaContextCb.push(() => {
                    Ya.Context.AdvManager.render({
                        "blockId": "R-A-7609325-5",
                        "renderTo": "yandex_rtb_R-A-7609325-5"
                    })
                })
            </script>
        </div>
    </div>
</section>
<!-- anime related Init Start-->
<?php include_once 'src/components/animeRelated/animeRelated.php'; ?>
<!-- anime related Init End-->
<!-- anime characters Init Start -->
<?php include_once 'src/components/charactersList/characters.php' ?>
<!-- anime charactrs Init End -->
<!-- anime footer Init Start -->
<?php include_once 'src/components/footer/footer.php'; ?>
<!-- anime footer Init End -->

<!-- scripts -->
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script src="https://kit.fontawesome.com/36abf4b57f.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.2/anime.min.js"
        integrity="sha512-aNMyYYxdIxIaot0Y1/PLuEu3eipGCmsEUBrUq+7aVyPGMFH8z0eTP0tkqAvv34fzN6z+201d3T8HPb1svWSKHQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--<script src="js/anime/getAnimeInKodik.js"></script>-->
<script>
    var kodikAddPlayers = {
        width: "100%",
        height: "100%",
        onDomReady: false,
        shikimoriID: `${currentAnime}`,
        foundCallback: function (data, link) {
        },
        notFoundCallback: function (data) {
            console.log("eta anime chkaa ara");
            animesNotfound()
        },
        translationID: "voices",
        types: "anime,anime-serial",
    };

    !function (e, n, t, r, a) {
        r = e.createElement(n), a = e.getElementsByTagName(n)
            [0], r.async = !0, r.src = t, a.parentNode.insertBefore(r, a)
    }
    (document, "script", "//kodik-add.com/add-players.min.js");

    async function animesNotfound() {
        let kodikSelector = document.getElementById("kodik-player");

        let noAnimeHTML = `
      <div class="kodik-anime-not-found">
        <h3>Нечего не найдено. 😔🚫</h3>
      </div>
    `;
        kodikSelector.insertAdjacentHTML('beforeend', noAnimeHTML);
    }

    fetch(`https://kodikapi.com/search?token=3cf56f8708e24622e6a5cc6747d0d3ee&shikimori_id=${currentAnime}&with_seasons=true&with_episodes_data=true&with_material_data=true`)
        .then(response => {
            return response.json();
        })
        .then(data => {
            console.log(data);
            let voicesBlockContainer = document.querySelector(".voices-and-subtitles-container");

            data.results.forEach(function (item) {
                console.log(item.translation.title);

                let totalEpisodesCount = 0;
                if (item.seasons) {
                    Object.values(item.seasons).forEach(season => {
                        if (season.episodes) {
                            totalEpisodesCount += Object.keys(season.episodes).length;
                        }
                    });
                }

                let VoicesLinkTemplateHTML = `
                <a class="voice-${item.translation.id}" href="/anime.php?animeId=${currentAnime}&voice=${item.translation.id}">
                    ${item.translation.title}
                    <span>${totalEpisodesCount} серии</span>
                </a>
            `;
                voicesBlockContainer.insertAdjacentHTML('beforeend', VoicesLinkTemplateHTML);
                console.log(totalEpisodesCount);
            });

            let seasonsBlockContainer = document.querySelector(".seasons-container");
            let currentAnimeResult;
            if (currentAnimeVoice == null) {
                currentAnimeResult = data.results[0];
            } else if (data.results.find(item => item.translation.id === currentAnimeVoice)) {
                currentAnimeResult = data.results.find(item => item.translation.id === currentAnimeVoice);
            }
            else if (data.results.find(item => item.translation.id !== currentAnimeVoice)) {
                currentAnimeResult = data.results[0];
                console.log("sins")
            }

            if (currentAnimeResult) {
                console.log(currentAnimeResult);
                for (let seasonIndex in currentAnimeResult.seasons) {
                    if (currentAnimeResult.seasons.hasOwnProperty(seasonIndex)) {
                        let season = currentAnimeResult.seasons[seasonIndex];
                        for (let key in season.episodes) {
                            if (season.episodes.hasOwnProperty(key)) {
                                let episode = season.episodes[key];
                                let episodeBlockContainerHTML = `
                    <a href="/anime.php">Сезон ${seasonIndex}, Серия ${key}</a>
                `;
                                seasonsBlockContainer.insertAdjacentHTML('beforeend', episodeBlockContainerHTML);
                            }
                        }
                    }
                }
            }
        })
        .catch(error => {
            console.error('fetch error => ', error);
        });


</script>
<script defer src="js/_BLACKLIST.js"></script>
<script defer src="js/other/delay.js"></script>
<script defer src="js/other/scrollToAnchor.js"></script>

<script defer src="js/anime/getCurrAnime.js"></script>
<script defer src="js/anime/appendAnimeInSite.js"></script>
<script defer src="js/animeRelated/animeRelated.js"></script>
<script defer src="js/anime/selectVoicesOrSeasons.js"></script>
<script defer>
    async function __INIT__() {
        await getCurrAnime(currentAnime);
    }

    window.addEventListener('load', async () => {
        console.log("%cНачинаю Выполнение запросов...", "color: aqua");
        await __INIT__()
    });
</script>
</body>

</html>