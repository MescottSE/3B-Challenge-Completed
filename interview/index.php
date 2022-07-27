<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
   integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
   integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
   crossorigin=""></script>

  </head>
  <div class="nav-bar">
    <div class="nav-logo">
      <img id="logo" src="./images/logo.png">
    </div>
  </div>
  <div class="main-body">
    <div class="container-fluid px-0">
      <div class="main-panel">
        <div class="col-sm-8 nopadding">
          <div class="articles-panel">
            <div class="articles-head">Articles</div>
            <div class="articles-body">
              <?php
                $articles = file_get_contents('./data/articles.json');
                $events = file_get_contents('./data/events.json');

                $articles = json_decode($articles, true);
                $events = json_decode($events, true);

                foreach($articles as $article){
                  echo '<div class="col-sm-6">';
                    echo '<div class="article-body">';
                      echo '<div class="article-title">' . $article['title'] . '</div>';
                      echo '<img class="article-image" src="' . $article['image'] . '">';
                      echo '<div class="article-content-container">';
                        echo '<div class="article-content">' . $article['content'] . '</div>';
                      echo '</div>';
                    echo '</div>';
                  echo '</div>';
                }
              ?>
            </div>
          </div>
        </div>
        <div class="col-sm-4 nopadding">
          <div class="events-panel">
            <div class="events-head">Events</div>
            <div class="events-body">
              <?php
                foreach($events as $event){
                  echo '<div class="event-panel">';
                    echo '<div class="event-title">' . $event['title'] . '</div>';
                    echo '<div><span class="bold-me">Location</span> ' . $event['location'] . '</div>';
                    echo '<div><span class="bold-me">Date</span> ' . $event['date'] . '</div>';
                  echo '</div>';
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="mapid"></div>

  <script>
    var map = L.map('mapid').setView([50, 0], 4);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    <?php
      foreach($events as $event){
        // echo 'let markerOptions = {
        //   title: "' . $event['title'] .'",
        //   clickable: true,
        //   draggable: true
        // }';
        echo 'L.marker([' . $event['geo']['lat'] . ',' . $event['geo']['lng'] . '],{title:"' . $event['title'] . '"}).addTo(map);';
      }
    ?>

  </script>
</html>