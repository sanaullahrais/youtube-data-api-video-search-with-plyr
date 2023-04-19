<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Video Search with Custom Plyr</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.4/plyr.css" />
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    h1 {
    font-family: 'Maven Pro', Verdana, Geneva, Tahoma, sans-serif !important;
    font-weight: 800 !important;
}
    .container {
    background: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 15px 10px #00000012;
}
    
   body {
    background: #f6f6f6;
}
  </style>
  
  </head>
<body>
    <div class="container mt-3">
        <h1 class="text-center" style="margin-bottom:20px;">YouTube Player</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="text" id="search-input" class="form-control form-control-lg" placeholder="Search for videos...">
                    <div class="input-group-append">
                        <button id="search-button" class="btn btn-primary" type="button">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="player-container"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.plyr.io/3.6.4/plyr.js"></script>
    <script>
        const playerContainer = document.getElementById('player-container');

        function createPlayer(videoId) {
            playerContainer.innerHTML = `<div data-plyr-provider="youtube" data-plyr-embed-id="${videoId}"></div>`;
            return new Plyr(playerContainer.firstChild);
        }

        let player = createPlayer('bTqVqk7FSmY'); // Default video

        document.getElementById('search-button').addEventListener('click', () => {
            const searchTerm = document.getElementById('search-input').value;

            const requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };
          
          /* SET YOUR YOUTUBE DATA API KEY HERE BELOW "YOURAPIKEYHERE" */
          
            fetch(`https://www.googleapis.com/youtube/v3/search?part=snippet&q=${searchTerm}&type=video&key=YOURAPIKEYHERE`, requestOptions)
                .then(response => response.json())
                .then(data => {
                    const videoId = data.items[0].id.videoId;
                    player.destroy(); // Destroy the previous player instance
                    player = createPlayer(videoId); // Create a new player with the new video
                })
                .catch(error => console.log('error', error));
        });
    </script>
</body>
</html>
